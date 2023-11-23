<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OrganisationService;

class OrganisationController extends Controller
{
    public function getDataForTransactionForm(OrganisationService $service)
    {
        return $service->getDataForTransactionForm();
    }
}
