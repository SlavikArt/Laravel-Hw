<?php

namespace App\Http\Controllers;

use App\Facades\Currency;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CurrencyController extends Controller
{
    public function convert(Request $request): JsonResponse
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'from' => 'required|string|size:3',
            'to' => 'required|string|size:3'
        ]);

        try {
            $convertedAmount = Currency::convert(
                $request->amount,
                $request->from,
                $request->to
            );

            return response()->json([
                'converted_amount' => round($convertedAmount, 2)
            ]);
        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }
} 