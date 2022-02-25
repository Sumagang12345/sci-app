<?php

namespace App\Http\Controllers;

use App\Models\employee as Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $employees = Employee::get();

        return view('home', [
            'employees' => $employees,
            'title' => 'Dashboard',
        ]);
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return view('auth.login');
    }
}
