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

use Exception;
 
class TransactionService
{
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
        $data = $request->all();

        try {   
            DB::beginTransaction();

            $status = TransactionStatusEnum::PENDING->value;

            if ($data['type'] === TransactionTypeEnum::Purchase->value) {
                $status = TransactionStatusEnum::APPROVED->value;
            }

            $transaction = Transaction::create([
                'amount' => $data['amount'],
                'description' => $data['description'],
                'type' => $data['type'],
                'status' => $status,
                'user_id' => $request->user()->id
            ]);

            if (isset($data['check'])) {
                $check =null;

                $check = $data['check'];
                $path = 'checks/';
                $fileName = $transaction->id . "." . $check->getClientOriginalExtension();

                Storage::putFileAs($path, new File($check), $fileName);

                $transaction->check = $path . $fileName;
                $transaction->save();
            }

            DB::commit();

            return $transaction;
        } catch (Exception $e) {
            DB::rollback();

            throw new Exception($e->getMessage());
        }        
    }
}