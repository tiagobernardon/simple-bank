<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Support\Facades\Storage;

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

    public function getCheck(Request $request)
    {
        $path = $this->service->getCheckPath($request);
        $file = Storage::path($path);
        return response()->file($file);
    }

    public function update(UpdateTransactionRequest $request, $id)
    {
        if ($request->user()->can('update', Transaction::class)) {
            $updated = $this->service->update($request, $id);
            return response()->json($updated, 200);
        }

        return response()->json()->setStatusCode(403);
    }
}
