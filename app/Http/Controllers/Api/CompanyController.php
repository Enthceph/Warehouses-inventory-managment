<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\Response;
use App\Http\Requests\CreateCompanyRequest;
use App\Http\Resources\CompanyCollection;
use App\Http\Resources\CompanyResource;

class CompanyController extends Controller
{
    public function __construct(
        protected CompanyService $service
    ) {
    }

    public function index() : CompanyResource
    {
        return new CompanyResource($this->service->get());
    }

    public function store(CreateCompanyRequest $request) : CompanyResource
    {
        $this->authorize('store', Company::class);

        return new CompanyResource($this->service->store($request));
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $this->authorize('update', $company);

        $this->service->update($request, $company);
    }

    public function destroy(Company $company)
    {
        $this->authorize('update', $company);

        $this->service->destroy($company);
    }
}
