<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ReCaptchaService
{
    protected string $secretKey;
    protected string $siteKey;

    public function __construct()
    {
        $this->secretKey = config('services.recaptcha.secret_key');
        $this->siteKey = config('services.recaptcha.site_key');
    }

    public function getSiteKey(): string
    {
        return $this->siteKey;
    }

    public function verify(?string $token, ?string $expectedAction = null): array
    {
        /*
        |--------------------------------------------------------------------------
        | Check token
        |--------------------------------------------------------------------------
        */

        if (!$token) {
            return [
                'success' => false,
                'score' => 0,
                'message' => 'No reCAPTCHA token provided.',
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Check configuration
        |--------------------------------------------------------------------------
        */

        if (!$this->secretKey) {
            Log::error('reCAPTCHA secret key is missing.');

            return [
                'success' => false,
                'score' => 0,
                'message' => 'reCAPTCHA is not configured correctly.',
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Send token to Google
        |--------------------------------------------------------------------------
        */

        try {

            $response = Http::asForm()
                ->timeout(10)
                ->post(
                    'https://www.google.com/recaptcha/api/siteverify',
                    [
                        'secret' => $this->secretKey,
                        'response' => $token,
                    ]
                );

        } catch (\Throwable $e) {

            Log::error('reCAPTCHA HTTP request failed.', [
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'score' => 0,
                'message' => 'Unable to contact the reCAPTCHA service. Please try again.',
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Check HTTP response
        |--------------------------------------------------------------------------
        */

        if (!$response->successful()) {

            Log::error('reCAPTCHA returned an HTTP error.', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [
                'success' => false,
                'score' => 0,
                'message' => 'The reCAPTCHA service returned an error. Please try again.',
            ];
        }

        $data = $response->json();

        /*
        |--------------------------------------------------------------------------
        | Log Google response
        |--------------------------------------------------------------------------
        */

        Log::info('Google reCAPTCHA response.', [
            'success' => $data['success'] ?? false,
            'score' => $data['score'] ?? null,
            'action' => $data['action'] ?? null,
            'hostname' => $data['hostname'] ?? null,
            'error_codes' => $data['error-codes'] ?? [],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Google verification failed
        |--------------------------------------------------------------------------
        */

        if (!($data['success'] ?? false)) {

            $errorCodes = $data['error-codes'] ?? ['unknown-error'];

            return [
                'success' => false,
                'score' => 0,
                'message' => 'reCAPTCHA verification failed. Error codes: '
                    . implode(', ', $errorCodes),
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Get score
        |--------------------------------------------------------------------------
        */

        $score = (float) ($data['score'] ?? 0);

        /*
        |--------------------------------------------------------------------------
        | Verify action
        |--------------------------------------------------------------------------
        */

        if ($expectedAction !== null) {

            $actualAction = $data['action'] ?? null;

            if ($actualAction !== $expectedAction) {

                Log::warning('reCAPTCHA action mismatch.', [
                    'expected' => $expectedAction,
                    'actual' => $actualAction,
                ]);

                return [
                    'success' => false,
                    'score' => $score,
                    'message' => 'reCAPTCHA action verification failed.',
                ];
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Verify score
        |--------------------------------------------------------------------------
        */

        if ($score < 0.5) {

            return [
                'success' => false,
                'score' => $score,
                'message' => 'Security verification failed. Please try again.',
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Everything passed
        |--------------------------------------------------------------------------
        */

        return [
            'success' => true,
            'score' => $score,
            'message' => 'Human verified.',
        ];
    }
}