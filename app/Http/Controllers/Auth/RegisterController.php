<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'role_id' => ['required', 'integer'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        //send email before inerting into DB
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->all();
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $msg = '<div class="alert alert-success">
                    <span class="success_message">Thanks for signing up.<br>
                        An email containing verification link has been sent to your email address. Please verify email to continue.
                        <br>
                        If you did not receive the email <a id="resend_email" href="/email/resend/' . $data['email'] . '">click here to request another</a>.
                    </span>
                </div>';
        // $this->guard()->login($user);
        return $this->registered($request, $user)
            ?: response()->json(['status' => 1, 'message' => $msg]);
    }

    public function verify($id, $hash)
    {
        $user = Auth::loginUsingId($id);
        if (isset($user->id)) {
            if (!hash_equals(
                (string) $hash,
                sha1($user->getEmailForVerification())
            )) {
                Auth::logout();
                return redirect('/')->with("success", 'Invalid or expired verification link');
            } else {
                if (!$user->hasVerifiedEmail()) {
                    $user->markEmailAsVerified();

                    event(new Verified($user));
                    $user->user_status = 1;
                    $user->save();

                    return redirect('/dashboard')->with("success", 'Email verified successfully');
                } else {
                    Auth::logout();
                    return redirect('/')->with("success", 'Email already verified, please login to continue');
                }
            }
        }
        Auth::logout();
        return redirect('/')->with("success", 'Invalid or expired verification link');
    }
}
