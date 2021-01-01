<?php

namespace Tests\Feature;

use App\Revenue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RevenueTest extends TestCase
{
    /** @test */
    public function a_revenue_can_be_created()
    {
        $response = $this->postJson('revenue',[
            'category'=>'income',
            'type'=>'petty',
            'amount'=>1500,
            'comment'=>'test revenue',
            'user_id'=>1,
        ]);

        $response->assertCreated();
    }

    /** @test */
    public function a_revenue_can_be_updated()
    {
        $this->postJson('revenue',[
            'category'=>'income',
            'type'=>'petty',
            'amount'=>1500,
            'comment'=>'test revenue',
            'user_id'=>1,
        ]);

        $revenue=Revenue::first();
        $this->patchJson('revenue/'.$revenue->id,[
            'amount'=>2000
        ]);

        $this->assertEquals(2000,Revenue::first()->amount);
    }

    /** @test */
    public function a_revenue_can_be_deleted()
    {
        $this->postJson('revenue',[
            'category'=>'income',
            'type'=>'petty',
            'amount'=>1500,
            'comment'=>'test revenue',
            'user_id'=>1,
        ]);

        $revenue=Revenue::first();
        $this->delete('revenue/'.$revenue->id);

        $this->assertSoftDeleted('revenues');
    }
}
