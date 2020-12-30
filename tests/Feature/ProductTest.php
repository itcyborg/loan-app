<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /** @test */
    public function a_product_can_be_created()
    {
        $response=$this->postJson('product',[
            'name'=>'product 1',
            'code'=>'test',
            'min_amount' =>1000,
            'max_amount' =>10000,
            'rate'=>12,
            'min_duration'=>6,
            'max_duration'=>12,
            'security'=>6000,
        ]);
        $response->assertCreated();
    }
}
