<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testDisplayLoginPage()
    {
        $response = $this->get('/login');

        $response
            ->assertSuccessful()
            ->assertViewIs('auth.login');
    }

    public function testNotShowLoginPageWhenUserAuthenticated()
    {
        $response = $this->post('/login', [
            'email' => 'phuoc@gmail.com',
            'password' => '123456798',
        ]);

        $user = Auth::user();

        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/home');
        $response->assertOk();
    }

    public function testUserCanLoginWithCorrectCredentials()
    {
        $response = $this->post('/login', [
            'email' => 'phuoc@gmail.com',
            'password' => '123456798',
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticated();
        $response->assertSuccessful();
    }

    public function testUserCanNotLoginWithWrongCredentials()
    {
        $response = $this->from('/login')->post('/login', [
            'email' => 'phuoc@gmail.com',
            'password' => 'sdfgsdfhrt',
        ]);
        
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('password');

        $this->assertGuest();
    }
}
