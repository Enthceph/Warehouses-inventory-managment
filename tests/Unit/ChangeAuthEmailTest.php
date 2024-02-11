<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ChangeAuthEmailTest extends TestCase
{
    use DatabaseTransactions;

    public function test_change_auth_email()
    {
        Company::factory()->create();
        $user = User::factory()->create();

        $this
            ->actingAs($user, 'sanctum')
            ->patchJson('api/changeEmail', [
                'email' => 'changed@email.com'
            ])
            ->assertOk();
    }

    public function test_change_auth_email_with_wrong_key()
    {
        Company::factory()->create();
        $user = User::factory()->create();

        $this
            ->actingAs($user, 'sanctum')
            ->patchJson('api/changeEmail', [
                'emails' => 'changed@email.com'
            ])
            ->assertStatus(422);
    }

    public function test_change_auth_email_with_null()
    {
        Company::factory()->create();
        $user = User::factory()->create();

        $this
            ->actingAs($user, 'sanctum')
            ->patchJson('api/changeEmail')
            ->assertStatus(422);
    }
}
