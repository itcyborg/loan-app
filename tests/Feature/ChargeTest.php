<?php

namespace Tests\Feature;

use App\Charge;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $response->assertOk();
    }

    /**
     * @test
     */
    public function a_charge_can_be_created()
    {
        $this->withoutExceptionHandling();
        $response=$this->postJson('charge',[
            'name'=>'chagos',
            'amount'=>1500,
            'type'=>'fixed',
            'product_id'=>1
        ]);
        $response->assertCreated();
    }

    /**
     * @test
     */
    public function a_charge_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->postJson('charge',[
            'name'=>'chagos',
            'amount'=>1500,
            'type'=>'fixed',
            'product_id'=>1
        ]);
        $charge=Charge::first();
        $this->patchJson('charge/'.$charge->id,[
            'amount'=>2000
        ]);
        self::assertEquals(2000,(string) Charge::first()->amount);
    }

    /** @test */
    public function a_charge_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        $this->postJson('charge',[
            'name'=>'chagos',
            'amount'=>1500,
            'type'=>'fixed',
            'product_id'=>1
        ]);
        $charge=Charge::first();
        $response=$this->delete('charge/'.$charge->id);
        $response->assertSuccessful();
    }
}
