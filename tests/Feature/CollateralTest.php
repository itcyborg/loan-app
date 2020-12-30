<?php

namespace Tests\Feature;

use App\Collateral;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CollateralTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function a_collateral_can_be_created()
    {
        $response=$this->postJson('collateral',[
            'loan_id'=>1,
            'type'=>'electronic',
            'details'=>'Samsung tv',
            'value'=>5000,
        ]);

        $response->assertCreated();
    }

    /** @test */
    public function a_collateral_can_be_updated()
    {
        $this->postJson('collateral',[
            'loan_id'=>1,
            'type'=>'electronic',
            'details'=>'Samsung tv',
            'value'=>5000,
        ]);
        $collateral=Collateral::first();
        $this->patchJson('collateral/'.$collateral->id,[
            'details'=>'LG TV 32 inch'
        ]);
        $this->assertEquals('LG TV 32 inch',Collateral::first()->details);
    }
    /** @test */
    public function a_collateral_can_be_deleted()
    {
        $this->postJson('collateral',[
            'loan_id'=>1,
            'type'=>'electronic',
            'details'=>'Samsung tv',
            'value'=>5000,
        ]);
        $collateral=Collateral::first();
        $response=$this->delete('collateral/'.$collateral->id);
        $response->assertSuccessful();
    }
}
