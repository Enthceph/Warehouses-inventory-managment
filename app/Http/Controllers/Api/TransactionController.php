<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTransactionRequest;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    public function index(TransactionService $service)
    {
        return $service->get();
    }

    public function store(CreateTransactionRequest $request, TransactionService $service)
    {
        return $service->store($request);
    }

    public function show(TransactionService $service)
    {

    }

    public function update(TransactionService $service)
    {

    }

    public function destroy(TransactionService $service)
    {

    }
}
