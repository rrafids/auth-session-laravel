<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

use App\Models\Admin;
use App\Models\Team;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if(!empty(Admin::where('email', $request->session()->get('emailAdmin'))->first())) {
            $admin = Admin::where('email', $request->session()->get('emailAdmin'))->first();
            $teams = Team::all();

            view('templates.admins.header')->with('emailAdmin', $admin->email);

            return view('pages.Admins.index')->with([
                'teams' => $teams
            ]);
        }

        return view('pages.Admins.index');
    }

    public function registerPage()
    {
        return view('auth.Admins.register');
    }

    public function loginPage()
    {
        return view('auth.admins.login');
    }

    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        Admin::Create(
            [
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]
        );

        return redirect('/admin/login')->with('success', 'Pendaftaran akun berhasil, silakan login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if(!empty(Admin::where('email', $request->email)->first())) {
            $Admin = Admin::where('email', $request->email)->first();
            if(Hash::check($request->password, $Admin->password)) {
                $request->session()->put('token_admin', $this->token());
                $request->session()->put('nameAdmin', $Admin->name);
                $request->session()->put('emailAdmin', $Admin->email);

                Admin::where('email', $request->email)->Update(
                    [
                        'token' => $request->session()->get('token_admin')
                    ]
                );

                return redirect('/admin');
            }
        }

        return view('auth.Admins.login');
    }

    public function logout(Request $request)
    {
        $token = $request->session()->get('token_admin');
        $Admin = Admin::where('token', $token)->first();

        $Admin->update([
            'token' => null
        ]);

        $request->session()->flush();

        return redirect('/admin/login');
    }

    public function activate(Request $request)
    {
        if(!empty(Admin::where('email', $request->session()->get('emailAdmin'))->first())) {
            Team::where('id', $request->id)->update([
                'status' => 1
            ]);

            return redirect('/admin')->with('success', 'Berhasil Mengaktifkan Tim');
        }

        return view('pages.Admins.login');
    }

    public function deactivate(Request $request)
    {
        if(!empty(Admin::where('email', $request->session()->get('emailAdmin'))->first())) {
            Team::where('id', $request->id)->update([
                'status' => 0
            ]);

            return redirect('/admin')->with('success', 'Berhasil Menonaktifkan Tim');
        }

        return view('pages.Admins.login');
    }

    public function token()
    {
        $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 12;
        $code = substr(str_shuffle($str), 0, $length);

        return $code;
    }
}
