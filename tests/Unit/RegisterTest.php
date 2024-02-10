<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    public function test_user_and_company_can_be_registered()
    {
        $response = $this->post('api/register', $this->getValidUserData());

        $response->assertStatus(200);
        $response->assertJson(['message' => 'User created']);

        $this->assertDatabaseHas('companies', ['name' => 'Test Company']);
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);

        $user = User::where('email', 'test@example.com')->first();
        $this->assertNotNull($user->company_id);
        $this->assertEquals('Test Company', $user->company->name);
    }

    private function getValidUserData(): array
    {
        return [
            'user' => [
                'full_name' => 'Test User',
                'email' => 'test@example.com',
                'password' => 'qwertyui',
                'password_confirmation' => 'qwertyui',
            ],
            'company' => [
                'name' => 'Test Company',
                'address' => 'Test Address',
                'contact_info' => 'Test Contact Info',
            ]
        ];
    }

    // company
    public function test_company_name_is_empty()
    {
        $userData = $this->getValidUserData();
        $userData['company']['name'] = '';
        $response = $this->post('api/register', $userData);

        $response->assertStatus(422);
    }

    public function test_company_name_is_null()
    {
        $userData = $this->getValidUserData();
        $userData['company']['name'] = null;
        $response = $this->post('api/register', $userData);

        $response->assertStatus(422);
    }

    //name

    public function test_user_name_is_invalid()
    {
        $userData = $this->getValidUserData();
        $userData['user']['full_name'] = '';
        $response = $this->post('api/register', $userData);

        $response->assertStatus(422);
    }

    public function test_user_name_is_null()
    {
        $userData = $this->getValidUserData();
        $userData['user']['full_name'] = null;
        $response = $this->post('api/register', $userData);

        $response->assertStatus(422);
    }

    //email

    public function test_user_email_is_invalid()
    {
        $userData = $this->getValidUserData();
        $userData['user']['email'] = 'not an email';
        $response = $this->post('api/register', $userData);

        $response->assertStatus(422);
    }

    public function test_user_email_is_empty()
    {
        $userData = $this->getValidUserData();
        $userData['user']['email'] = '';
        $response = $this->post('api/register', $userData);

        $response->assertStatus(422);
    }

    public function test_user_email_is_null()
    {
        $userData = $this->getValidUserData();
        $userData['user']['email'] = null;
        $response = $this->post('api/register', $userData);

        $response->assertStatus(422);
    }

    // password

    public function test_user_password_is_invalid()
    {
        $userData = $this->getValidUserData();
        $userData['user']['password'] = 'asd';
        $response = $this->post('api/register', $userData);

        $response->assertStatus(422);
    }

    public function test_user_password_is_empty()
    {
        $userData = $this->getValidUserData();
        $userData['user']['password'] = '';
        $response = $this->post('api/register', $userData);

        $response->assertStatus(422);
    }

    public function test_user_password_is_null()
    {
        $userData = $this->getValidUserData();
        $userData['user']['password'] = null;
        $response = $this->post('api/register', $userData);

        $response->assertStatus(422);
    }

    public function test_user_password_is_not_confirmed()
    {
        $userData = $this->getValidUserData();
        $userData['user']['password_confirmation'] = '';
        $response = $this->post('api/register', $userData);

        $response->assertStatus(422);
    }

}
