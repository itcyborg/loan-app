<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class ChargeTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @return void
     */
    public function test_list_charges(): void
    {
        $response = $this->get('/charge');
        $response->assertStatus(200);
    }

//    public function test_create_charge(): void
//    {
//        $attributes =[
//            'log_id'=>Str::uuid(),
//            'name'=>'Charge 1',
//        ];
//    }
}
