<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyService
{
    public function get() : Company
    {
        return Auth::user()->company()->firstOrFail();
    }
    public function store($request)
    {

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
