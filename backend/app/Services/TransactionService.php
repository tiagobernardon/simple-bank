<?php

namespace App\Services;
 
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

use Exception;
 
class TransactionService
{
    public function list(Request $request) : Collection
    {
        if ($request->user()->can('viewAll', Transaction::class)) {
            $transactions = Transaction::get();
        } else {
            $transactions = $request->user()->transactions;
        }

        return $transactions;
    }
    
    public function create(Request $request) : Transaction
    {
        $data = $request->all();

        try {   
            DB::beginTransaction();

            $transaction = Transaction::create([
                'amount' => $data['amount'],
                'description' => $data['description'],
                'type' => $data['type'],
                'status' => 'PENDING',
                'user_id' => $request->user()->id
            ]);

            if (isset($data['check'])) {
                $check =null;
                $checkPath = null;
                $checkFileName = null;

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