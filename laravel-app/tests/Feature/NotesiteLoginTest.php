<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class NotesiteLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_post_does_not_return_csrf_mismatch(): void
    {
        $response = $this->post('/api.php?a=login', [
            'email' => 'not-an-email',
            'password' => 'secret123',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['error' => 'Please enter a valid email.']);
    }

    public function test_login_accepts_legacy_pass_field(): void
    {
        $user = User::factory()->create([
            'email' => 'demo@example.com',
            'password' => Hash::make('secret123'),
            'role' => 'User',
        ]);

        $response = $this->post('/api.php?a=login', [
            'email' => 'demo@example.com',
            'pass' => 'secret123',
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('user.email', $user->email);
    }
}
