<?php

namespace Tests\Unit;


use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_view_login_form()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_user_can_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'first_name' => 'first_name',
            'last_name' => 'last_name',
            'email' => 'test@test.com',
            'role_id' => 2,
            'password' => Hash::make('password123')
        ]);

        $response = $this->post('api/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cant_login_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'first_name' => 'first_name',
            'last_name' => 'last_name',
            'email' => 'test@test.com',
            'role_id' => 2,
            'password' => Hash::make('password123')
        ]);

        $wrong_password = $this->post('api/login', [
            'email' => $user->email,
            'password' => 'wrong password',
        ]);

        $wrong_email = $this->post('api/login', [
            'email' => 'wrong@email.com',
            'password' => 'password123',
        ]);

        $this->assertAuthenticated($wrong_password);
        $this->assertAuthenticated($wrong_email);

    }
}
