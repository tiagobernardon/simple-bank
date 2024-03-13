<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    protected $service;

    public function __construct(TransactionService $transactionService)
    {
        $this->service = $transactionService;
    }

    public function index(Request $request)
    {
        $transactions = $this->service->list($request);

        return response()->json($transactions, 200);
    }

    public function store(StoreTransactionRequest $request)
    {
        if ($request->user()->can('store', Transaction::class)) {
            $transaction = $this->service->create($request);

            return response()->json($transaction, 200);
        }

        return response()->json()->setStatusCode(403);
    }

    public function show(Transaction $transaction)
    {
        //
    }

    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

}
