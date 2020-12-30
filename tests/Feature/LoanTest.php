<?php

namespace Tests\Feature;

use App\Loan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoanTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_loan_application_can_be_created()
    {
        $this->withoutExceptionHandling();
        $response = $this->postJson('loan',[
            'product_id'=>1,
            'rate'=>12,
            'purpose'=>'fees',
            'amount_applied'=>12000,
            'duration'=>6,
            'repayment_frequency'=>'monthly',
            'customer_id'=>1,
            'applied_by'=>1,
            'product_config'=>'test',
        ]);

        $response->assertCreated();
        $this->assertCount(1,Loan::all());
    }

    /** @test **/
    public function a_loan_application_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->postJson('loan',[
            'product_id'=>1,
            'rate'=>12,
            'purpose'=>'fees',
            'amount_applied'=>12000,
            'duration'=>6,
            'repayment_frequency'=>'monthly',
            'customer_id'=>1,
            'applied_by'=>1,
            'product_config'=>'test',
        ]);

        $loan=Loan::first();

        $response=$this->patchJson('loan/'.$loan->id,[
            'amount_approved'=>10000
        ]);
        $this->assertEquals(10000,Loan::first()->amount_approved);
    }

    /** @test */
    public function a_loan_application_can_be_deleted()
    {

        $this->withoutExceptionHandling();
        $this->postJson('loan',[
            'product_id'=>1,
            'rate'=>12,
            'purpose'=>'fees',
            'amount_applied'=>12000,
            'duration'=>6,
            'repayment_frequency'=>'monthly',
            'customer_id'=>1,
            'applied_by'=>1,
            'product_config'=>'test',
        ]);

        $loan=Loan::first();

        $response=$this->delete('loan/'.$loan->id);
        $response->assertSuccessful();
    }
}
