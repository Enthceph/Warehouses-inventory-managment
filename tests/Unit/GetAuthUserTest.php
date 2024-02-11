<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class GetAuthUserTest extends TestCase
{
    use DatabaseTransactions;

    public function test_it_returns_authenticated_user_with_role_and_company()
    {
        $company = Company::factory()->create(['name' => 'Test Company']);

        $user = User::factory()->create([
            'full_name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'role_id' => 2,
            'company_id' => $company->id,
        ]);

        $response = $this
            ->actingAs($user, 'sanctum')
            ->getJson('api/getAuthUser')
            ->assertOk();


        $this->assertEquals($user->id, $response['id']);
        $this->assertEquals('John Doe', $response['full_name']);
        $this->assertEquals('johndoe@example.com', $response['email']);
        $this->assertEquals('Owner', $response['role']);
        $this->assertEquals('Test Company', $response['company']);
        $this->assertEquals($user->created_at, Carbon::parse($response['created_at']));
    }
}
