<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\PetugasSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_can_view_login_and_registration_forms(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSee('Login Petugas')
            ->assertSee('name="email"', false)
            ->assertSee('name="password"', false);

        $this->get(route('register'))
            ->assertOk()
            ->assertSee('Register Petugas')
            ->assertSee('name="name"', false)
            ->assertSee('name="password_confirmation"', false);
    }

    public function test_guests_can_open_the_reporting_form_and_submit_a_report(): void
    {
        $this->get(route('lapor-banjir.form'))
            ->assertOk()
            ->assertSee(route('login'))
            ->assertSee(route('register'));

        $this->post(route('lapor-banjir.store'), [
            'nama' => 'Warga Bandung',
            'kecamatan' => 'Baleendah',
            'desa' => 'Andir',
            'tinggi_genangan' => 35,
        ])->assertRedirect(route('lapor-banjir.konfirmasi'));

        $this->assertDatabaseHas('lapor_banjirs', [
            'nama' => 'Warga Bandung',
            'desa' => 'Andir',
        ]);
    }

    public function test_guest_is_redirected_to_login_from_the_report_list(): void
    {
        $this->get(route('lapor-banjir.index'))
            ->assertRedirect(route('login'));
    }

    public function test_registration_validates_and_hashes_the_password(): void
    {
        $this->post(route('register'), [])->assertSessionHasErrors([
            'name',
            'email',
            'password',
        ]);

        $this->post(route('register'), [
            'name' => 'Petugas Baru',
            'email' => 'petugas@example.test',
            'password' => 'password-rahasia',
            'password_confirmation' => 'password-rahasia',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'name' => 'Petugas Baru',
            'email' => 'petugas@example.test',
        ]);

        $this->assertTrue(Hash::check(
            'password-rahasia',
            User::where('email', 'petugas@example.test')->value('password'),
        ));
    }

    public function test_login_rejects_invalid_credentials_and_accepts_valid_credentials(): void
    {
        User::factory()->create([
            'email' => 'petugas@example.test',
            'password' => Hash::make('password-rahasia'),
        ]);

        $this->post(route('login'), [
            'email' => 'petugas@example.test',
            'password' => 'salah',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();

        $this->post(route('login'), [
            'email' => 'petugas@example.test',
            'password' => 'password-rahasia',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticated();
    }

    public function test_authenticated_user_sees_profile_and_staff_navigation(): void
    {
        $user = User::factory()->create([
            'name' => 'Petugas Bandung',
            'email' => 'petugas@example.test',
        ]);

        $this->actingAs($user)
            ->get(route('profile'))
            ->assertOk()
            ->assertSee('Petugas Bandung')
            ->assertSee('petugas@example.test')
            ->assertSee($user->created_at->format('d-m-Y H:i'))
            ->assertSee('Daftar Laporan')
            ->assertSee('Profil Petugas')
            ->assertSee('Logout');
    }

    public function test_petugas_seeder_creates_five_staff_accounts_and_a_fixed_admin_account(): void
    {
        $this->seed(PetugasSeeder::class);

        $this->assertDatabaseCount('users', 6);
        $this->assertSame(5, User::where('email', 'like', 'petugas%')->count());

        $admin = User::where('email', 'admin@bpbdbandung.test')->firstOrFail();

        $this->assertSame('Admin BPBD', $admin->name);
        $this->assertTrue(Hash::check('Admin12345', $admin->password));

        $this->post(route('login'), [
            'email' => 'admin@bpbdbandung.test',
            'password' => 'Admin12345',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($admin);
    }

    public function test_logout_ends_the_authenticated_session(): void
    {
        $this->actingAs(User::factory()->create())
            ->post(route('logout'))
            ->assertRedirect(route('lapor-banjir.form'));

        $this->assertGuest();
    }
}
