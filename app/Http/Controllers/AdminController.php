<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    // Halaman login
    public function loginForm()
    {
        if (session()->has('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $admin = Admin::where('username', $request->username)
            ->orWhere('email', $request->username)
            ->first();

        if ($admin && $admin->verifyPassword($request->password) && $admin->is_active) {
            session(['admin_logged_in' => true]);
            session(['admin_id' => $admin->id]);
            session(['admin_username' => $admin->username]);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', '❌ Username atau password salah!');
    }

    // Logout
    public function logout()
    {
        session()->forget('admin_logged_in');
        session()->forget('admin_id');
        session()->forget('admin_username');
        return redirect()->route('admin.login')->with('success', '✅ Berhasil logout!');
    }

    // Halaman dashboard
    public function dashboard()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu!');
        }
        return view('admin.dashboard');
    }

    // Halaman profile & ganti password
    public function profile()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $admin = Admin::find(session('admin_id'));
        return view('admin.profile', compact('admin'));
    }

    // Proses ganti password
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $admin = Admin::find(session('admin_id'));

        if (!$admin->verifyPassword($request->current_password)) {
            return back()->with('error', '❌ Password saat ini salah!');
        }

        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return back()->with('success', '✅ Password berhasil diubah!');
    }

    // Halaman lupa password
    public function forgotPasswordForm()
    {
        return view('admin.forgot-password');
    }

    // Proses reset password (POST)
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email'
        ]);

        $admin = Admin::where('email', $request->email)->first();
        $token = $admin->generateResetToken();

        // Tampilkan token di halaman (bukan kirim email)
        return back()->with([
            'success' => '✅ Token reset password telah dibuat!',
            'reset_token' => $token
        ]);
    }

    // Halaman reset password
    public function resetPasswordForm($token)
    {
        $admin = Admin::where('reset_token', $token)
            ->where('reset_token_expires', '>', now())
            ->first();

        if (!$admin) {
            return redirect()->route('admin.login')->with('error', '❌ Token reset tidak valid atau sudah kadaluarsa!');
        }

        return view('admin.reset-password', compact('token'));
    }
    // Update profile (username & email)
    public function updateProfile(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:admins,username,' . session('admin_id'),
            'email' => 'required|email|max:100|unique:admins,email,' . session('admin_id')
        ]);

        $admin = Admin::find(session('admin_id'));
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->save();

        // Update session
        session(['admin_username' => $request->username]);

        return back()->with('success', '✅ Profile berhasil diupdate!');
    }
    // Proses reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $admin = Admin::where('reset_token', $request->token)
            ->where('reset_token_expires', '>', now())
            ->first();

        if (!$admin) {
            return back()->with('error', '❌ Token reset tidak valid atau sudah kadaluarsa!');
        }

        $admin->password = Hash::make($request->password);
        $admin->reset_token = null;
        $admin->reset_token_expires = null;
        $admin->save();

        return redirect()->route('admin.login')->with('success', '✅ Password berhasil direset! Silakan login dengan password baru.');
    }
}
