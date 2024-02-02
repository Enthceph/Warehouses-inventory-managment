<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CompanyService
{
    public function get()
    {
        return Auth::user()->company()->firstOrFail();
    }

    public function store($request)
    {

    }


    public function update($request, int $id)
    {
        $company = Company::find($id);
        return $company->update($request->all());
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        return $company->delete();
    }

}
