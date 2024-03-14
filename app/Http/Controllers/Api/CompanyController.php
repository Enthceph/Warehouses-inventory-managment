<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct(
        protected CompanyService $service
    ) {
    }

    public function index() : Company
    {
        // $this->authorize('view', $company);

        return $this->service->get();
    }

    public function store(Request $request)
    {
        //TODO просто для вида хотя бы сделать
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $this->authorize('update', Company::class);

        $this->service->update($request, $company);

        return response(['message' => 'Company was updated']);
    }

    public function destroy(Company $company)
    {
        $this->authorize('update', $company);

        $this->service->destroy($company);

        return response(['message' => 'Company was deleted']);
    }
}
