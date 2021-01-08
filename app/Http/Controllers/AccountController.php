<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Auth;
use Redirect;
use View;
use App\Models\User;
use App\Models\Group;
use App\Models\CompanyAccounts;
use App\Models\CompanyAccountAddress;
use App\Models\CompanyAccountCertificates;
use App\Models\CompanyCustomCertificates;
use App\Models\CompanyCertificates;
use App\Models\UserCategories;
use App\Models\Countries;
use App\Models\Currencies;

use AuthenticatesUsers;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

use Validator;
use DB;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $data['popular_machines'] = Group::orderBy('group_name', 'asc')->get();
        if($user){
            $data['user'] = $user;
            $company_data = $user->CompanyAccount;
            if($company_data){
                $company_address_data = $company_data->CompanyAddress;
                $company_location_data = $company_data->CompanyAddress->first();
                $company_certificate_data = $company_data->CompanyCertificate()->first();
                // dd($company_certificate_data);
                $company_custom_certificates = $company_data->CompanyCustomCertificate;
            }
            else{
                $company_address_data = [];
                $company_custom_certificates = [];
                $company_location_data = null;
                $company_certificate_data = [];
            }

            $country_list = Countries::where('is_active', 1)->get();
            $currency_list = Currencies::get();
            $company_certificates = CompanyCertificates::get();
            if($user->role_id == 1) {
                return view('dashboard.customer.account-settings',$data)
                        ->withCompany($company_data)
                        ->with('company_address', $company_address_data)
                        ->with('company_location', $company_location_data)
                        ->with('company_account_certificate', $company_certificate_data)
                        ->with('company_certificates', $company_certificates)
                        ->with('company_custom_certificates', $company_custom_certificates)
                        ->with('countries', $country_list)
                        ->with('currencies', $currency_list);
            }
            return view('dashboard.supplier.account-settings',$data)
                        ->withCompany($company_data)
                        ->with('company_address', $company_address_data)
                        ->with('company_location', $company_location_data)
                        ->with('company_certificates', $company_certificates)
                        ->with('company_account_certificate', $company_certificate_data)
                        ->with('company_custom_certificates', $company_custom_certificates)
                        ->with('countries', $country_list)
                        ->with('currencies', $currency_list);
        }
        else{
            return view('landingpage.index', $data);
        }
    }

    /**
     * account setting data update
     * @return 
     */
    public function create_update(Request $request)
    {
        $data = $request->all();
        $rule = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'company_name' => 'required',
            'tax_id' => 'required',
            'vat_percent' => 'required',
            'company_address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'country_id' => 'required',
            'category_id' => 'required',
        );
        
        $rule['email'] = [
            'required', 'email', 'max:255', Rule::unique((new User)->getTable())->ignore(Auth::id() ?? null)
        ];
        

        $validator = Validator::make($request->all(), $rule);



        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)
                                ->withInput();
            // return response()->json([
            //                     'message' => 'Invalid parameters.',
            //                     'errors'  => $validator->errors()
            //                 ], 422);
        }

        $user = Auth::user();

        $company = $user->CompanyAccount;
        if(!$company || $company == null){
            $company = new CompanyAccounts();
        }

        // company log upload
        $company_logo = $request->file('company_logo');
        if($company_logo) {
            $ext = $company_logo->extension();
            $fileName = $company_logo->getClientOriginalName();
            $fileSize = $company_logo->getsize();
            $maxSize = $company_logo->getMaxFileSize();
            $maxSizeMB = round($company_logo->getMaxFileSize() / 1024 / 1024, 0);

            if($fileSize == 0 || $fileSize > $maxSize) {
                return response()->json([
                    'message' => 'Company logo upload failed.',
                    'errors'  => 'File size must be maximum ' . $maxSizeMB
                ], 422);
            }
            else {
                $path = get_user_file_path($user->id, $subdir = '/company_logo', true);
                $company_logo->storeAs($path, $fileName, 'public');
                $company->logo = $fileName;
            }
        }
         
        $company->company_name = $data['company_name'];
        $company->company_description = $data['company_description'];
        $company->tax_id = $data['tax_id'];
        $company->vat_percent = $data['vat_percent'];
        $company->save();

        $new_company = CompanyAccounts::orderby('id', 'desc')->first();

        if($new_company && $new_company != null) {

            // company address
            $company_address_delete = CompanyAccountAddress::where('company_account_id', $new_company->id)
                                ->delete();
            // foreach($data['company_address'] as $address){
                $company_address = CompanyAccountAddress::create([
                                    'company_account_id' => $new_company->id,
                                    'company_address' => $data['company_address'],
                                    'country_id' => $data['country_id'],
                                    'state' => $data['state'],
                                    'city' => $data['city'],
                                    'zip_code' => $data['zip_code']
                                ]);
            // }
            
            // company certificate 
            $company_certificate = CompanyAccountCertificates::updateOrCreate(
                                        ['company_account_id' => $new_company->id],
                                        ['company_certificate_id' => $data['company_certificates_id']]
                                    );

            // company_custom_certificates
            CompanyCustomCertificates::where('company_account_id', $new_company->id)
                                ->delete();
            if(isset($data['company_custom_certificates'])){
                foreach($data['company_custom_certificates'] as $certificates){
                    $company_custom_certificates = CompanyCustomCertificates::create([
                                                'company_account_id' => $new_company->id,
                                                'certificate_party' => $certificates->certificate_party,
                                                'certificate_number' => $certificates->certificate_number,
                                                'expire_date' => $certificates->certificate_expire_date,
                                            ]);
                }
            }
            
            // user account update
            if($user){
                $user->first_name = $data['first_name'];
                $user->last_name = $data['last_name'];
                $user->email = $data['email'];
                if($data['password'] != ''){
                    $user->password = Hash::make($data['password']);
                }
                $user->profile_desc = $data['profile_desc'];
                $user->company_account_id = $new_company->id;
                $user->currency_id = $data['currency_id'];
                // company log upload
                $user_photo = $request->file('personal_photo');
                if($user_photo) {
                    $ext = $user_photo->extension();
                    $fileName = $user_photo->getClientOriginalName();
                    $fileSize = $user_photo->getsize();
                    $maxSize = $user_photo->getMaxFileSize();
                    $maxSizeMB = round($user_photo->getMaxFileSize() / 1024 / 1024, 0);
    
                    if($fileSize == 0 || $fileSize > $maxSize) {
                        return response()->json([
                            'message' => 'Company logo upload failed.',
                            'errors'  => 'File size must be maximum ' . $maxSizeMB
                        ], 422);
                    }
                    else {
                        $path = get_user_file_path($user->id, $subdir = '/user_photo', true);
                        $user_photo->storeAs($path, $fileName, 'public');
                        $user->logo = $fileName;
                    }
                }
                
                $user->save();
    
                $user_categories = UserCategories::updateOrCreate(
                                    ['user_id' => $user->id],
                                    ['category_id' => $data['category_id']]
                                );
    
            }
        }



        // return response()->json([
        //     'message' => 'successful save.',
        //     'errors'  => ''
        // ], 210);
        return Redirect::back();
    }
}
