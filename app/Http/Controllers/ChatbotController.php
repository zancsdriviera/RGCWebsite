<?php

namespace App\Http\Controllers;

use App\Services\ChatbotService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    /**
     * Handle chatbot messages.
     */
    public function message(
        Request $request,
        ChatbotService $chatbotService
    ): JsonResponse {
        $validated = $request->validate([
            'message' => [
                'required',
                'string',
                'max:2000',
            ],

            'history' => [
                'nullable',
                'array',
                'max:10',
            ],

            'history.*.role' => [
                'nullable',
                'string',
                'in:user,assistant',
            ],

            'history.*.content' => [
                'nullable',
                'string',
                'max:4000',
            ],
        ]);

        $reply = $chatbotService->getResponse(
            $validated['message'],
            $validated['history'] ?? []
        );

        return response()->json([
            'success' => true,
            'reply' => $reply,
        ]);
    }
}