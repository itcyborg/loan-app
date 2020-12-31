<?php

namespace Tests\Feature;

use App\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function a_customer_can_be_created()
    {
        $response = $this->postJson('customer',[
            'name'=>'bill',
            'email'=>'bill@example.com',
            'gender'=>'male',
            'identification_document'=>'national_id',
            'identification_number'=>'12354112',
            'primary_contact'=>0712121511,
            'alternative_contact'=>'0712121578',
            'address'=>'123 ad',
            'longitude'=>'32.4521W',
            'latitude'=>'01.1254N',
            'date_of_birth'=>Carbon::now()->toDateString(),
            'nationality'=>'Kenyan',
            'agent_id'=>1,
        ]);

        $response->assertCreated();
    }

    /**
     * @test
     */
    public function a_customer_can_be_updated()
    {
        $this->postJson('customer',[
            'name'=>'bill',
            'email'=>'bill@example.com',
            'gender'=>'male',
            'identification_document'=>'national_id',
            'identification_number'=>'12354112',
            'primary_contact'=>0712121511,
            'alternative_contact'=>'0712121578',
            'address'=>'123 ad',
            'longitude'=>'32.4521W',
            'latitude'=>'01.1254N',
            'date_of_birth'=>Carbon::now()->toDateString(),
            'nationality'=>'Kenyan',
            'agent_id'=>1,
        ]);

        $customer=Customer::first();
        $this->patchJson('customer/'.$customer->id,[
            'name'=>'jane'
        ]);
        $this->assertEquals('jane',Customer::first()->name);
    }

    /** @test */
    public function a_customer_can_be_deleted()
    {
        $this->postJson('customer',[
            'name'=>'bill',
            'email'=>'bill@example.com',
            'gender'=>'male',
            'identification_document'=>'national_id',
            'identification_number'=>'12354112',
            'primary_contact'=>0712121511,
            'alternative_contact'=>'0712121578',
            'address'=>'123 ad',
            'longitude'=>'32.4521W',
            'latitude'=>'01.1254N',
            'date_of_birth'=>Carbon::now()->toDateString(),
            'nationality'=>'Kenyan',
            'agent_id'=>1,
        ]);

        $customer=Customer::first();
        $this->delete('customer/'.$customer->id);
        $this->assertSoftDeleted('customers');
    }
}
