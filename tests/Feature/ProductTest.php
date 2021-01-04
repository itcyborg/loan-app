<?php

namespace Tests\Feature;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_product_can_be_created()
    {
        $this->withoutExceptionHandling();
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

    /**
     * @test
     */
    public function a_product_can_be_updated()
    {
        $this->postJson('product',[
            'name'=>'product 1',
            'code'=>'test',
            'min_amount' =>1000,
            'max_amount' =>10000,
            'rate'=>12,
            'min_duration'=>6,
            'max_duration'=>12,
            'security'=>6000,
        ]);
        $product=Product::first();
        $this->patchJson('product/'.$product->id,[
            'name'=>'product 2'
        ]);
        $this->assertEquals('product 2',Product::first()->name);
    }


    /**
     * @test
     */
    public function a_product_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        $this->postJson('product',[
            'name'=>'product 1',
            'code'=>'test',
            'min_amount' =>1000,
            'max_amount' =>10000,
            'rate'=>12,
            'min_duration'=>6,
            'max_duration'=>12,
            'security'=>6000,
        ]);
        $product=Product::first();

        $response=$this->delete('product/'.$product->id);
        $response->assertSuccessful();
    }
}
