<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (! Auth::attempt($credentials, $remember)) {

            return back()
                ->withErrors([
                    'email' => 'Email atau kata sandi tidak sesuai.',
                ])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        /**
         *  nanti kalau ada role
         *
         * if(Auth::user()->role == 'admin'){
         *      return redirect()->route('dashboard');
         * }
         *
         * if(Auth::user()->role == 'user'){
         *      return redirect()->route('dashboard');
         * }
         */

        return redirect()
            ->route('dashboard')
            ->with('success', 'Selamat datang kembali!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
