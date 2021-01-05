<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user()
    {
        $this->withoutExceptionHandling();
        $response=$this->post('/api/user',[
            'name'=>'test',
            'password'=>Hash::make('password'),
            'email'=>'test@app.com'
        ]);
        $response->assertStatus(201);
        $this->get('/api/user')->assertSee('test');
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_list_users()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/api/user');

        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_login()
    {
        $this->withoutExceptionHandling();
        $this->post('/api/user',[
            'name'=>'test',
            'password'=>Hash::make('password'),
            'email'=>'test@app.com'
        ]);
        $response=$this->post('login',[
            'email'=>'test@app.com',
            'password'=>'password'
        ]);
        $response->assertRedirect('home');
    }
}
