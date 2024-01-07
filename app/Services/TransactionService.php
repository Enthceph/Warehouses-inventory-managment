<?php

namespace App\Services;

use App\Http\Requests\CreateTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function get()
    {
        $transactions = Transaction::with(['product', 'type', 'outlet'])->get();
        return TransactionResource::collection($transactions);
    }

    public function store(CreateTransactionRequest $request)
    {
        Debugbar::log($request);

        DB::transaction(function () use ($request) {
            Transaction::create([
                'amount' => $request->amount,
                'description' => $request->description,
                'type_id' => $request->type_id,
                'outlet_id' => $request->outlet_id,
                'product_id' => $request->product_id,
            ]);


        });

        return $request;
    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
