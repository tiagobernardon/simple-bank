<?php

namespace App\Services;
 
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

            DB::commit();

            return $transaction;
        } catch (Exception $e) {
            DB::rollback();

            throw new Exception($e->getMessage());
        }        
    }
}