<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use App\User;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('criterias')->get();
        $data1 = DB::table('subCriterias')->get();
        return view('dashboard',compact('data','data1'));

        //return view('Report.reportInput');
    }

    public function attachRoles($userId, $role){
        $user = User::find($userId);
        $roleId = DB::table('roles')->where('slug', $role)->value('id');
        $user->attachRole($roleId); // you can pass whole object, or just an id
        //$user->detachRole($adminRole); // in case you want to detach

        return redirect()->back();
    }
}
