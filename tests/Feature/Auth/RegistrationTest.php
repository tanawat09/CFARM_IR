<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $this->setPublicRegistration(true);

        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $this->setPublicRegistration(true);

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_registration_is_not_available_when_public_registration_is_disabled(): void
    {
        $this->setPublicRegistration(false);

        $this->get('/register')->assertNotFound();

        $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])->assertNotFound();

        $this->assertGuest();
    }

    private function setPublicRegistration(bool $enabled): void
    {
        $value = $enabled ? 'true' : 'false';

        putenv("ALLOW_PUBLIC_REGISTRATION={$value}");
        $_ENV['ALLOW_PUBLIC_REGISTRATION'] = $value;
        $_SERVER['ALLOW_PUBLIC_REGISTRATION'] = $value;

        $this->refreshApplication();
        $this->artisan('migrate');
    }
}
