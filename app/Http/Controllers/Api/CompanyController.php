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
    )
    {
    }

    public function index()
    {
        $company = $this->service->get();

        $this->authorize('view', $company);

        return $company;
    }

    public function store(Request $request)
    {
        //
    }

    public function update(UpdateCompanyRequest $request, int $id)
    {
        $this->authorize('update', Company::findOrFail($id));

        $companyUpdated = $this->service->update($request, $id);

        if (!$companyUpdated) {
            return response()->json(['message' => 'Failed to update the company.'], 422);
        }

        return response(Company::findOrFail($id));
    }

    public function destroy($id)
    {
        $this->authorize('update', Company::findOrFail($id));

        $this->service->destroy($id);

        return response(['message' => 'Company was deleted']);
    }
}
