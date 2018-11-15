<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;


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
        if (\Auth::user()->can('admin') == 1) {
            return redirect('/admin/dashboardAdmin');
        } elseif (\Auth::user()->can('user') == 2) {
            return redirect('/user/dashboardUser');
        }
    }
}
