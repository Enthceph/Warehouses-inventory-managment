<?php

namespace App\Services;

use App\Models\Inventory;
use App\Models\Organisation;
use App\Models\TransactionCategory;
use Illuminate\Support\Facades\Auth;

class OrganisationService
{
    public function getDataForTransactionForm()
    {
        $org = Organisation::findOrFail(Auth::id());

        $categories = TransactionCategory::get(['id', 'category']);

        $outlets = collect($org->outlets)->map(function (object $outlet) {
            return [
                'id' => $outlet->id,
                'name' => $outlet->name,
            ];
        });

        $warehouses_id = $org->warehouses->pluck('id');
        $products = Inventory::whereIn('warehouse_id', $warehouses_id)
            ->get()
            ->map(function (object $warehouse) {
                return [
                    'id' => $warehouse->id,
                    'product_name' => $warehouse->product_name,
                ];
            });

        $warehouses = collect($org->warehouses)->map(function (object $warehouse) {
            return [
                'id' => $warehouse->id,
                'name' => $warehouse->name,
            ];
        });

        return [
            'categories' => $categories,
            'outlets' => $outlets,
            'products' => $products,
            'warehouses' => $warehouses,
        ];
    }
}
