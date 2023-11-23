<?php

namespace App\Services;

use App\Http\Requests\CreateTransactionRequest;
use Barryvdh\Debugbar\Facades\Debugbar;

class TransactionService
{
    public function get()
    {

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
