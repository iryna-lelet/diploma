<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = ['LoggedInUser' => User::where('id', '=', session('LoggedUser'))->first()];
        return view('sections.dashboard', $data);
    }

    public function logout()
    {
        if(session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return redirect('login');
        }
    }
}
