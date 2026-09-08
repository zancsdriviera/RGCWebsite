<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use Illuminate\Support\Facades\Session;
use App\Services\ReCaptchaService;

class LoginController extends Controller
{
    protected ReCaptchaService $recaptchaService;

    public function __construct(ReCaptchaService $recaptchaService)
    {
        $this->recaptchaService = $recaptchaService;
    }

    public function index()
    {
        return view('admin.index');
    }

    public function login(Request $request)
    {
        // Validate login fields
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Verify Google reCAPTCHA
        |--------------------------------------------------------------------------
        */

        $recaptchaToken = $request->input('recaptcha_token');

        if (!$recaptchaToken) {
            return back()
                ->withErrors([
                    'recaptcha' => 'Security verification failed. Please refresh the page and try again.'
                ])
                ->onlyInput('email');
        }

        // Verify token with Google through our service
        $recaptchaResult = $this->recaptchaService->verify(
            $recaptchaToken,
            'admin_login'
        );

        // Log result for debugging
        \Log::info('reCAPTCHA login verification', [
            'success' => $recaptchaResult['success'] ?? false,
            'score' => $recaptchaResult['score'] ?? 0,
            'message' => $recaptchaResult['message'] ?? null,
        ]);

        if (!$recaptchaResult['success']) {
            return back()
                ->withErrors([
                    'recaptcha' => $recaptchaResult['message']
                        ?? 'Security verification failed. Please try again.'
                ])
                ->onlyInput('email');
        }

        /*
        |--------------------------------------------------------------------------
        | Check admin credentials
        |--------------------------------------------------------------------------
        */

        $admin = Login::where('email', $request->email)->first();

        if ($admin && password_verify($request->password, $admin->password)) {

            Session::put('admin', true);

            return redirect()->route('admin.home');
        }

        return back()
            ->withErrors([
                'credentials' => 'Invalid credentials.'
            ])
            ->onlyInput('email');
    }

    public function logout()
    {
        Session::forget('admin');

        return redirect()->route('admin.index');
    }
}