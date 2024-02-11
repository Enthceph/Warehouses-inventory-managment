<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ChangeAuthPasswordTest extends TestCase
{
    use DatabaseTransactions;

    public function test_change_auth_password()
    {
        Company::factory()->create();
        $user = User::factory()->create();

        $this
            ->actingAs($user, 'sanctum')
            ->patchJson('api/changePassword', [
                'new_password' => "asdfgh",
                'password_confirmation' => "asdfgh",
                'old_password' => "qwertyui",
            ])
            ->assertOk();
    }

    public function test_change_auth_password_with_wrong_keys()
    {
        Company::factory()->create();
        $user = User::factory()->create();

        $this
            ->actingAs($user, 'sanctum')
            ->patchJson('api/changePassword', [
                'wrong_key' => "asdfgh",
                'old_password' => "qwertyui",
                'password_confirmation' => "qwertyui",
            ])
            ->assertStatus(422);

        $this
            ->actingAs($user, 'sanctum')
            ->patchJson('api/changePassword', [
                'new_password' => "asdfgh",
                'old_password' => "qwertyui",
                'wrong_key' => "qwertyui",
            ])
            ->assertStatus(422);

        $this
            ->actingAs($user, 'sanctum')
            ->patchJson('api/changePassword', [
                'new_password' => "asdfgh",
                'wrong_key' => "qwertyui",
                'password_confirmation' => "qwertyui",
            ])
            ->assertStatus(422);
    }

    public function test_change_auth_password_with_null()
    {
        Company::factory()->create();
        $user = User::factory()->create();

        $this
            ->actingAs($user, 'sanctum')
            ->patchJson('api/changePassword')
            ->assertStatus(422);
    }
}
