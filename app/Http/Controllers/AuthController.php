<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Testing\Fluent\Concerns\Has;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function signup()
    {
        return view('auth.signup');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->back();
    }

    public function forbidAccess()
    {
        return redirect()->back();
    }

    public function save(Request $request): \Illuminate\Http\RedirectResponse
    {
         $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required|min:8|max:16',
        ]);

         $user = new User;
         $user->name = $request->name;
         $user->email = $request->email;
         $user->password = Hash::make($request->password);
         $save = $user->save();

         if($save) {
             return back()->with('success', 'New user has been successfully created!');
         } else {
             return back()->with('fail', 'Something went wrong, please, try again later...');
         }
    }

    public function check(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:16',
        ]);

        $userInfo = User::where('email', '=', $request->email)->first();

        if(!$userInfo){
            return back()->with('fail', 'Sorry, we do not recognize you...');
        } else {
            if(Hash::check($request->password, $userInfo->password)) {
                $request->session()->put('LoggedUser', $userInfo->id);

                return redirect('/');
            } else {
                return back()->with('fail', 'Incorrect password');
            }
        }
    }
}
