<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\Response;
use App\Http\Requests\CreateCompanyRequest;

class CompanyController extends Controller
{
    public function __construct(
        protected CompanyService $service
    ) {
    }

    public function index() : Company
    {
        return $this->service->get();
    }

    public function store(CreateCompanyRequest $request) : Company
    {
        $this->authorize('store', Company::class);

        return $this->service->store($request);
    }

    public function update(UpdateCompanyRequest $request, Company $company) : Response
    {
        $this->authorize('update', Company::class);

        $this->service->update($request, $company);

        return response(['message' => 'Company was updated']);
    }

    public function destroy(Company $company) : Response
    {
        $this->authorize('update', $company);

        $this->service->destroy($company);

        return response(['message' => 'Company was deleted']);
    }
}
