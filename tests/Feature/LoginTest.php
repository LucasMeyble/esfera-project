<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_view_a_login_form(): void
    {
        $response = $this->get('/');

        $response->assertSuccessful();
        $response->assertViewIs('login');
    }

    public function test_user_can_login_with_correct_credentials()
    {

        $user = User::factory()->create(
            [
                'password' => bcrypt('i-love-laravel'),
            ]
        );

        $response = $this->post(route('auth.login'), [
            'email' => $user->email,
            'password' => 'i-love-laravel',
        ]);

        $response->assertRedirect('tasks');
        $this->assertAuthenticatedAs($user);
    }
}
