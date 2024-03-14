<?php

namespace App\Services;
 
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Pagination\Paginator;
use App\Enums\TransactionTypeEnum;
use App\Enums\TransactionStatusEnum;
use App\Services\WalletService;

use Exception;
 
class TransactionService
{
    protected $walletService;

    public function __construct(Walletservice $walletService)
    {
        $this->walletService = $walletService;
    }

    public function list(Request $request) : Paginator
    {
        $userId = null;

        if ($request->user()->cannot('viewAll', Transaction::class)) {
            $userId = $request->user()->id;
        }

        $transactions = Transaction::ofUser($userId)
                            ->orderByDesc('created_at')
                            ->simplePaginate(7);

        return $transactions;
    }

    public function create(Request $request) : Transaction
    {
        try {   
            $data = $request->all();

            DB::beginTransaction();

            $status = $this->setInitialStatus($data, $request);

            $transaction = Transaction::create([
                'amount' => $data['amount'],
                'description' => $data['description'],
                'type' => $data['type'],
                'status' => $status,
                'user_id' => $request->user()->id
            ]);

            if (isset($data['check'])) {
                $this->saveCheck($data, $transaction);
            }

            if ($transaction->type === TransactionTypeEnum::Purchase->value) {
                $this->walletService->removeFunds($request, $transaction);
            }

            DB::commit();

            return $transaction;
        } catch (Exception $e) {
            DB::rollback();

            throw new Exception($e->getMessage());
        }        
    }

    public function getCheckPath(Request $request) : string
    {
        try {
            $path = '';
            $transaction = Transaction::find($request->transactionId);

            if ($transaction) {
                $path = $transaction->check;
            }

            return $path;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(Request $request, $id) : string
    {
        try {
            $data = $request->only(['status']);

            DB::beginTransaction();

            $transaction = Transaction::find($id);

            $transaction->status = $data['status'];

            $transaction->save();

            if ($transaction->status === TransactionStatusEnum::APPROVED->value) {
                $this->walletService->addFunds($transaction);
            }

            return $transaction->id;

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            throw new Exception($e->getMessage());
        }
    }

    public function saveCheck(array $data, Transaction $transaction) : void
    {
        $check = null;

        $check = $data['check'];
        $path = 'checks/';
        $fileName = $transaction->id . "." . $check->getClientOriginalExtension();

        Storage::putFileAs($path, new File($check), $fileName);

        $transaction->check = $path . $fileName;
        $transaction->save();
    }

    public function setInitialStatus(array $data, Request $request) : string
    {
        $status = TransactionStatusEnum::PENDING->value;

        if ($data['type'] === TransactionTypeEnum::Purchase->value) {
            if ($data['amount'] > $request->user()->wallet->balance) {
                throw new Exception('Insufficient funds.');
            }

            $status = TransactionStatusEnum::APPROVED->value;
        }

        return $status;
    }
}