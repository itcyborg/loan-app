<?php

namespace Tests\Feature;

use App\Guarantor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class GuarantorTest extends TestCase
{

    use RefreshDatabase;
    /** @test */
    public function a_guarantor_can_be_created()
    {
        $response = $this->postJson('guarantor',[
            'customer_id'=>1,
            'loan_id'=>1,
            'name'=>'guarantor test',
            'email'=>'guarantor@app.com',
            'gender'=>'female',
            'identification_document'=>'national_id',
            'identification_number'=>'111313214',
            'primary_contact'=>0711215112,
            'alternative_contact'=>0710012544,
            'address'=>'454 eldoret',
            'date_of_birth'=>Carbon::now()->toDateString(),
            'nationality'=>'Kenyan'
        ]);

        $response->assertCreated();
    }

    /** @test */
    public function a_guarantor_can_be_updated()
    {
        $this->postJson('guarantor',[
            'customer_id'=>1,
            'loan_id'=>1,
            'name'=>'guarantor test',
            'email'=>'guarantor@app.com',
            'gender'=>'female',
            'identification_document'=>'national_id',
            'identification_number'=>'111313214',
            'primary_contact'=>0711215112,
            'alternative_contact'=>0710012544,
            'address'=>'454 eldoret',
            'date_of_birth'=>Carbon::now()->toDateString(),
            'nationality'=>'Kenyan'
        ]);

        $guarantor=Guarantor::first();

        $this->patch('guarantor/'.$guarantor->id,[
            'nationality'=>'Ugandan'
        ]);

        $this->assertEquals('Ugandan',Guarantor::first()->nationality);
    }

    /** @test */
    public function a_guarantor_can_be_deleted()
    {
        $this->postJson('guarantor',[
            'customer_id'=>1,
            'loan_id'=>1,
            'name'=>'guarantor test',
            'email'=>'guarantor@app.com',
            'gender'=>'female',
            'identification_document'=>'national_id',
            'identification_number'=>'111313214',
            'primary_contact'=>0711215112,
            'alternative_contact'=>0710012544,
            'address'=>'454 eldoret',
            'date_of_birth'=>Carbon::now()->toDateString(),
            'nationality'=>'Kenyan'
        ]);

        $guarantor=Guarantor::first();

        $this->delete('guarantor/'.$guarantor->id);

        $this->assertSoftDeleted('guarantors');
    }
}
