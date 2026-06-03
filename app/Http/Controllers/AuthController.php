<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{
    // ============================================
    // LOGIN
    // ============================================
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // ============================================
    // REGISTRASI
    // ============================================
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:pengguna',
            'password' => 'required|string|min:6|confirmed',
            'no_telp' => 'nullable|string|max:20',
        ]);

        $pengguna = Pengguna::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'pelanggan', // Default role untuk registrasi publik
            'no_telp' => $validated['no_telp'],
        ]);

        Auth::login($pengguna);

        return redirect('/');
    }

    // ============================================
    // LUPA PASSWORD (OTP)
    // ============================================
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:pengguna,email']);
        
        $pengguna = Pengguna::where('email', $request->email)->first();
        
        // Generate 6 digit OTP
        $otp = sprintf("%06d", mt_rand(100000, 999999));
        
        $pengguna->otp = $otp;
        $pengguna->otp_expires_at = Carbon::now()->addMinutes(10);
        $pengguna->save();

        // Send real email via SMTP
        try {
            Mail::to($pengguna->email)->send(new OtpMail($pengguna->nama, $otp));
        } catch (\Exception $e) {
            Log::error("Gagal mengirim email OTP ke " . $pengguna->email . ": " . $e->getMessage());
            // Simpan backup OTP ke log jika pengiriman gagal agar dev/testing tetap jalan
            Log::info("KODE OTP RESET (BACKUP LOG): " . $otp);
        }

        // Backup log untuk kemudahan testing lokal
        Log::info("====================================");
        Log::info("KODE OTP UNTUK RESET PASSWORD BRIS");
        Log::info("Email Tujuan: " . $pengguna->email);
        Log::info("KODE OTP: " . $otp);
        Log::info("====================================");

        Session::put('reset_email', $pengguna->email);

        return redirect('/verify-otp')->with('success', 'Kode OTP telah dikirim ke email Anda.');
    }

    public function showVerifyOtpForm()
    {
        if (!Session::has('reset_email')) {
            return redirect('/forgot-password');
        }
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|string|size:6']);
        $email = Session::get('reset_email');
        
        $pengguna = Pengguna::where('email', $email)
            ->where('otp', $request->otp)
            ->where('otp_expires_at', '>', Carbon::now())
            ->first();

        if (!$pengguna) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid atau sudah kedaluwarsa.']);
        }

        Session::put('otp_verified', true);
        return redirect('/reset-password');
    }

    public function showResetPasswordForm()
    {
        if (!Session::has('otp_verified') || !Session::has('reset_email')) {
            return redirect('/forgot-password');
        }
        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $email = Session::get('reset_email');
        $pengguna = Pengguna::where('email', $email)->first();

        if ($pengguna) {
            $pengguna->password = Hash::make($request->password);
            $pengguna->otp = null;
            $pengguna->otp_expires_at = null;
            $pengguna->save();
            
            Session::forget(['reset_email', 'otp_verified']);
            
            return redirect('/login')->with('success', 'Password berhasil diubah. Silakan login dengan password baru.');
        }

        return redirect('/login')->withErrors(['error' => 'Gagal mengubah password.']);
    }
}
