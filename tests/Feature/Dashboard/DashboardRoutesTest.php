<?php

namespace Dashboard;

use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);
    }

    /**
     * Test the dashboard route for the Owner role.
     *
     * @return void
     */
    public function test_dashboard_route_for_owner()
    {
        $user = User::factory()->withRole(User::ROLE_OWNER)->create();

        $response = $this->actingAs($user)->get(route('dashboard.index'))->assertOk();
        $response->assertInertia(function ($page) {
            $page->component('Dashboard/Index');
            $page->has('auth.user');
        });
    }

    /**
     * Test the dashboard route for the Admin role.
     *
     * @return void
     */
    public function test_dashboard_route_for_admin()
    {
        $user = User::factory()->withRole(User::ROLE_ADMIN)->create();

        $response = $this->actingAs($user)->get(route('dashboard.index'));

        $response->assertStatus(200);
        $response->assertInertia(function ($page) {
            $page->component('Dashboard/Index');
            $page->has('user');
        });
    }

    /**
     * Test the dashboard route for the Moder role.
     *
     * @return void
     */
    public function test_dashboard_route_for_moder()
    {
        $user = User::factory()->withRole(User::ROLE_MODER)->create();

        $response = $this->actingAs($user)->get(route('dashboard.index'));

        $response->assertStatus(200);
        $response->assertInertia(function ($page) {
            $page->component('Dashboard/Index');
            $page->has('user');
        });
    }

    /**
     * Test the dashboard route for the User role.
     *
     * @return void
     */
    public function test_dashboard_route_for_user()
    {
        $user = User::factory()->withRole(User::ROLE_USER)->create();

        $response = $this->actingAs($user)->get(route('dashboard.index'));

        $response->assertStatus(200);
        $response->assertInertia(function ($page) {
            $page->component('Dashboard/Index');
            $page->has('user');
        });
    }

    /**
     * Test unauthenticated access to dashboard routes.
     *
     * @return void
     */
    public function test_unauthenticated_access_to_dashboard_routes()
    {
        $response = $this->get(route('dashboard.index'));
        $response->assertRedirect(route('login'));
    }
}
