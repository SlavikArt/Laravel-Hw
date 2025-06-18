<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class MySuperException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render(Request $request): Response|JsonResponse
    {
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'error' => 'MySuperException',
                'message' => $this->getMessage() ?: 'Сталася супер помилка!',
                'code' => $this->getCode() ?: 500,
                'timestamp' => now()->toISOString(),
            ], $this->getCode() ?: 500);
        }

        return response()->view('errors.my-super-ex', [
            'message' => $this->getMessage() ?: 'Сталася супер помилка!',
            'code' => $this->getCode() ?: 500,
        ], $this->getCode() ?: 500);
    }
}
