<?php

namespace Tests\Feature;

use App\Referee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RefereeTest extends TestCase
{

    use RefreshDatabase;
    /** @test */
    public function a_refee_can_be_added()
    {
//        $this->withExceptionHandling();
        $response = $this->postJson('referee',[
            'loan_id'=>1,
            'name'=>'sdasdadasda ad ',
            'gender'=>'male',
            'identification_document'=>'national_id',
            'identification_number'=>145121512,
            'primary_contact'=>0712123502,
            'alternative_contact'=>'0712215448',
            'nationality'=>'Kenyan',
        ]);
        $response->assertCreated();
    }

    /** @test */
    public function a_refee_can_be_updated()
    {
//        $this->withExceptionHandling();
        $this->postJson('referee',[
            'loan_id'=>1,
            'name'=>'sdasdadasda ad ',
            'gender'=>'male',
            'identification_document'=>'national_id',
            'identification_number'=>145121512,
            'primary_contact'=>0712123502,
            'alternative_contact'=>'0712215448',
            'nationality'=>'Kenyan',
        ]);
        $referee=Referee::first();
        $this->patchJson('referee/'.$referee->id,[
            'name'=>'bob'
        ]);
        $this->assertEquals('bob',Referee::first()->name);
    }

    /** @test */
    public function a_refee_can_be_deleted()
    {
//        $this->withExceptionHandling();
        $this->postJson('referee',[
            'loan_id'=>1,
            'name'=>'sdasdadasda ad ',
            'gender'=>'male',
            'identification_document'=>'national_id',
            'identification_number'=>145121512,
            'primary_contact'=>0712123502,
            'alternative_contact'=>'0712215448',
            'nationality'=>'Kenyan',
        ]);
        $referee=Referee::first();
        $this->delete('referee/'.$referee->id);
        $this->assertSoftDeleted('referees');
    }
}
