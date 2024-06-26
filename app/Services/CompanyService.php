<?php

namespace App\Services;

use App\Http\Requests\CreateCompanyRequest;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyService
{
    public function get() : Company
    {
        return Auth::user()->company;
    }

    public function store(CreateCompanyRequest $request)
    {
        return Company::create($request->validated());
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        return $company->update($request->validated());
    }
    public function destroy(Company $company)
    {
        return $company->delete();
    }
}
