<?php

namespace Tests\Feature\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_login_for_admin_routes(): void
    {
        $this->get('/admin/dashboard')
            ->assertRedirect('/login');
    }

    public function test_non_admin_users_are_forbidden_from_admin_routes(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/admin/dashboard')
            ->assertForbidden();
    }

    public function test_admin_users_can_access_admin_routes(): void
    {
        $adminRole = Role::create(['name' => 'admin']);

        $admin = User::factory()->create([
            'role_id' => $adminRole->id,
        ]);

        $this->actingAs($admin)
            ->get('/admin/dashboard')
            ->assertOk();
    }
}
