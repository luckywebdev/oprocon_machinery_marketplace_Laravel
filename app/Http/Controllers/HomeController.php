<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['popular_machines'] = Group::orderBy('group_name', 'asc')->get();
        $data['roles'] = Role::orderBy('role_name', 'asc')->get();
        // echo "as";die;
        return view('landingpage.index',$data);
    }
}
