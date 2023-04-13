<?php

namespace App\Http\Controllers;

use App\Models\Kullanici;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KullaniciController extends Controller
{
    // Show Register/Create Form
    public function create() {
        return view('kullanicilar.kayit');
    }

    // Create New User
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('kullanicilar', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create User
        $user = Kullanici::create($formFields);

        // Login
        auth()->login($user);

        return redirect('/')->with('message', 'Kullanıcı oluşturuldu ve oturum açıldı.');
    }

    // Logout User
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Oturum kapatıldı!');

    }

    // Show Login Form
    public function login() {
        return view('kullanicilar.giris');
    }

    // Authenticate User
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Giriş Başarılı!');
        }

        return back()->withErrors(['email' => 'Giriş Bilgileri Geçersiz'])->onlyInput('email');
    }

    public function edit()
    {
        return view('kullanicilar.edit', ['kullanicilar' => auth()->user()->get()]);
    }
}