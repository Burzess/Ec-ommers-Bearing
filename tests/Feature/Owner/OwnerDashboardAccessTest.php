<?php

namespace Tests\Feature\Owner;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OwnerDashboardAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_tamu_dialihkan_ke_login_saat_mengakses_dashboard_owner(): void
    {
        $response = $this->get(route('owner.dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_owner_bisa_mengakses_dashboard_owner(): void
    {
        $owner = User::factory()->owner()->create();

        $response = $this->actingAs($owner)->get(route('owner.dashboard'));

        $response->assertOk();
    }

    public function test_buyer_tidak_bisa_mengakses_dashboard_owner(): void
    {
        $buyer = User::factory()->create();

        $response = $this->actingAs($buyer)->get(route('owner.dashboard'));

        $response->assertForbidden();
    }

    public function test_admin_tidak_bisa_mengakses_dashboard_owner(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get(route('owner.dashboard'));

        $response->assertForbidden();
    }

    public function test_owner_tidak_bisa_mengakses_dashboard_admin(): void
    {
        $owner = User::factory()->owner()->create();

        $response = $this->actingAs($owner)->get(route('admin.dashboard'));

        $response->assertForbidden();
    }
}
