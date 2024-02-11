<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CheckAuthTest extends TestCase
{
    use DatabaseTransactions;

    public function test_authenticated_user_receives_a_positive_response()
    {
        Company::factory()->create();
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->getJson('/api/checkAuth');

        $response->assertStatus(200);
    }

    public function test_unauthenticated_user_receives_a_negative_response()
    {
        $response = $this->getJson('/api/checkAuth');

        $response->assertStatus(401);
    }
}
