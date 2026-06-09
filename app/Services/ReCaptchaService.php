<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ReCaptchaService
{
    protected $secretKey;
    protected $siteKey;

    public function __construct()
    {
        $this->secretKey = config('services.recaptcha.secret_key');
        $this->siteKey = config('services.recaptcha.site_key');
    }

    public function getSiteKey()
    {
        return $this->siteKey;
    }

    public function verify($token, $action = null)
    {
        if (!$token) {
            return [
                'success' => false,
                'score' => 0,
                'message' => 'No reCAPTCHA token provided'
            ];
        }

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $this->secretKey,
            'response' => $token,
        ]);

        $data = $response->json();

        if (!$data['success']) {
            return [
                'success' => false,
                'score' => 0,
                'message' => 'reCAPTCHA verification failed'
            ];
        }

        // Check if action matches (for security)
        if ($action && isset($data['action']) && $data['action'] !== $action) {
            return [
                'success' => false,
                'score' => $data['score'],
                'message' => 'Action mismatch'
            ];
        }

        // Score threshold: 0.5 is recommended by Google
        // Score 0.0 - 0.3: likely bot
        // Score 0.4 - 0.6: suspicious
        // Score 0.7 - 1.0: likely human
        $isValid = $data['score'] >= 0.5;

        return [
            'success' => $isValid,
            'score' => $data['score'],
            'message' => $isValid ? 'Human verified' : 'Bot detected (low score: ' . $data['score'] . ')'
        ];
    }
}