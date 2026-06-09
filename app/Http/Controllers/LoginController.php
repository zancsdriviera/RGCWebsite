<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function login(Request $request)
    {
        // Validate form fields
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Verify reCAPTCHA if token is present
        $recaptchaToken = $request->input('recaptcha_token');
        
        if (!$recaptchaToken) {
            return back()->withErrors(['recaptcha' => 'Security verification failed. Please refresh the page and try again.'])->onlyInput('email');
        }

        // Verify with Google
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $recaptchaToken,
        ]);

        $result = $response->json();
        
        // Debug: Log the verification result
        \Log::info('reCAPTCHA verification result', $result);

        if (!$result['success']) {
            return back()->withErrors(['recaptcha' => 'Security verification failed. Error codes: ' . implode(', ', $result['error-codes'] ?? ['unknown'])]);

        }

        // Check score (0.5 is threshold, adjust as needed)
        if ($result['score'] < 0.5) {
            return back()->withErrors(['recaptcha' => 'Security verification failed. Please try again.'])->onlyInput('email');
        }

        // Original login logic
        $admin = Login::where('email', $request->email)->first();
        
        if ($admin && password_verify($request->password, $admin->password)) {
            Session::put('admin', true);
            return redirect()->route('admin.home');
        }

        return back()->withErrors(['Invalid credentials'])->onlyInput('email');
    }

    public function logout()
    {
        Session::forget('admin');
        return redirect()->route('admin.index');
    }
}