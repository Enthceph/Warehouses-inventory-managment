<?php

namespace App\Services;

use App\Http\Requests\CreateTransactionRequest;
use App\Models\Transaction;
use Barryvdh\Debugbar\Facades\Debugbar;

class TransactionService
{
    public function get()
    {
        $transactinos = Transaction::get(['id', 'amount', 'type', 'outlet_id', 'created_at']);

        return $transactinos;
    }

    public function store(CreateTransactionRequest $request)
    {
        Debugbar::log($request);
//        Transaction::create([
//            'outlet_id' => '',
//            'date' => Carbon::now(),
//            'type' => '',
//            'amount' => '',
//            'description' => '',
//            'inventory_id' => '',
//            'product_name' => '',
//        ]);
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
