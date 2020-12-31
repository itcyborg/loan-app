<?php

namespace Tests\Feature;

use App\NextOfKin;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class NextOfKinTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_next_of_kin_can_be_added()
    {
        $this->withoutExceptionHandling();
        $faker = Factory::create();
        $response = $this->postJson('next_of_kin',[
            'name'=>$faker->name,
            'email'=>$faker->email,
            'gender'=>'male',
            'identification_document'=>'national_id',
            'identification_number'=>'44212454',
            'primary_contact'=>071121354,
            'alternative_contact'=>'079881122',
            'address'=>$faker->address,
            'date_of_birth'=>Carbon::now()->toDateTimeString(),
            'nationality'=>$faker->country,
            'relation'=>'brother',
            'loan_id'=>1
        ]);

        $response->assertCreated();
    }

    /** @test */
    public function a_next_of_kin_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $faker = Factory::create();
        $this->postJson('next_of_kin',[
            'name'=>$faker->name,
            'email'=>$faker->email,
            'gender'=>'male',
            'identification_document'=>'national_id',
            'identification_number'=>'44212454',
            'primary_contact'=>071121354,
            'alternative_contact'=>'079881122',
            'address'=>$faker->address,
            'date_of_birth'=>Carbon::now()->toDateTimeString(),
            'nationality'=>$faker->country,
            'relation'=>'brother',
            'loan_id'=>1
        ]);
        $next_of_kin=NextOfKin::first();
        $new=$faker->name;
        $this->patchJson('next_of_kin/'.$next_of_kin->id,[
            'name'=>$new
        ]);
        $this->assertEquals($new,NextOfKin::first()->name);
    }

    /** @test */
    public function a_next_of_kin_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        $faker = Factory::create();
        $this->postJson('next_of_kin',[
            'name'=>$faker->name,
            'email'=>$faker->email,
            'gender'=>'male',
            'identification_document'=>'national_id',
            'identification_number'=>'44212454',
            'primary_contact'=>071121354,
            'alternative_contact'=>'079881122',
            'address'=>$faker->address,
            'date_of_birth'=>Carbon::now()->toDateTimeString(),
            'nationality'=>$faker->country,
            'relation'=>'brother',
            'loan_id'=>1
        ]);
        $next_of_kin=NextOfKin::first();
        $this->delete('next_of_kin/'.$next_of_kin->id);
        $this->assertSoftDeleted('next_of_kin');
    }
}
