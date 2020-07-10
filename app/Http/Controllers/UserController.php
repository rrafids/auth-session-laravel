<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\Team;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if(!empty(User::where('email', $request->session()->get('emailUser'))->first())) {
            $user = User::where('email', $request->session()->get('emailUser'))->first();
            $team = Team::where('user_id', $user->id)->first();
            dd($team);
            view('templates.users.header')->with('nameUser', $user->name);

            return view('pages.users.index')->with([
                'user' => $user,
                'team' => $team
            ]);
        } else {
            
        }

        return view('pages.users.index');
    }

    public function registerPage()
    {
        return view('auth.users.register');
    }

    public function loginPage()
    {
        return view('auth.users.login');
    }

    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
            'name' => 'required',
        ]);

        User::Create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 0,
            ]
        );

        return redirect('/login')->with('success', 'Pendaftaran akun berhasil, silakan login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if(!empty(User::where('email', $request->email)->first())) {
            $user = User::where('email', $request->email)->first();
            if(Hash::check($request->password, $user->password)) {
                $request->session()->put('token_user', $this->token());
                $request->session()->put('nameUser', $user->name);
                $request->session()->put('emailUser', $user->email);

                User::where('email', $request->email)->Update(
                    [
                        'token' => $request->session()->get('token_user')
                    ]
                );

                return redirect('/');
            }
        }

        return view('auth.users.login');
    }

    public function logout(Request $request)
    {
        $token = $request->session()->get('token_user');
        $user = User::where('token', $token)->first();

        $user->update([
            'token' => null
        ]);

        $request->session()->flush();

        return redirect('/');
    }

    public function daftarTim(Request $request)
    {
        $this->validate($request, [
            'nama_tim' => 'required',
            'universitas' => 'required'
        ]);

        if(!empty(User::where('email', $request->session()->get('emailUser')))) {
            $user = User::where('email', $request->session()->get('emailUser'))->first();

            Team::Create(
                [
                    'nama_tim' => $request->nama_tim,
                    'universitas' => $request->universitas,
                    'status' => 0,
                    'user_id' => $user->id
                ]
            );

            User::where('email', $user->email)->Update(
                [
                    'status' => 1
                ]
            );

            return redirect('/')->with('success', 'Pendaftaran Tim Berhasil');
        }
    }

    public function token()
    {
        $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 12;
        $code = substr(str_shuffle($str), 0, $length);

        return $code;
    }


}
