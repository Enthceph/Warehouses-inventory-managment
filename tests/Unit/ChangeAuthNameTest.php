<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ChangeAuthNameTest extends TestCase
{
    use DatabaseTransactions;

    public function test_change_auth_name()
    {
        Company::factory()->create();
        $user = User::factory()->create();

        $this
            ->actingAs($user, 'sanctum')
            ->patchJson('api/changeName', [
                'name' => 'changed name'
            ])
            ->assertOk();
    }

    public function test_change_auth_name_with_wrong_key()
    {
        Company::factory()->create();
        $user = User::factory()->create();

        $this
            ->actingAs($user, 'sanctum')
            ->patchJson('api/changeName', [
                'names' => 'changed name'
            ])
            ->assertStatus(422);
    }

    public function test_change_auth_name_with_null()
    {
        Company::factory()->create();
        $user = User::factory()->create();

        $this
            ->actingAs($user, 'sanctum')
            ->patchJson('api/changeName')
            ->assertStatus(422);
    }
}
