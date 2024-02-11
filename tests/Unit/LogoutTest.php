<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use DatabaseTransactions;

    public function test_user_can_logout_successfully()
    {
        Company::factory()->create();
        $user = User::factory()->create();

        $this
            ->actingAs($user, 'sanctum')
            ->getJson('api/logout')
            ->assertOk();

        $this->assertDatabaseHas('personal_access_tokens', [
            'tokenable_id' => $user->id
        ]);
    }
}
