<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 3; $i++) {
            $company = Company::factory()->create();

            User::factory()->create([
                'role_id' => 2,
                'company_id' => $company->id
            ]);
        }
    }
}
