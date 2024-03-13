<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Services\WalletService;

class WalletController extends Controller
{
    protected $service;

    public function __construct(WalletService $walletService)
    {
        $this->service = $walletService;
    }

    public function getBalance(Request $request)
    {
        if ($request->user()->can('viewBalance', Wallet::class)) {
            $balance = $this->service->getCurrentBalance($request);

            return response()->json($balance, 200);
        }

        return response()->json()->setStatusCode(403);
    }
}
