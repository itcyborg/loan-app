<?php

namespace App\Http\Controllers;

use App\Clients;
use App\NextOfKin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Clients[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        return Cache::remember('clients',300,function(){
            return DB::table('clients')->get();
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'identification_document' => 'required',
            'identification_number' => 'required',
            'primary_contact' => 'required',
            'address' => 'required',
            'nationality' => 'required',
            'date_of_birth' => 'required',

            'kin_name' => 'required',
            'kin_identification_document' => 'required',
            'kin_identification_number' => 'required',
            'kin_relation' => 'required',
            'kin_nationality' => 'required',
            'kin_date_of_birth' => 'required',
            'kin_gender' => 'required',
            'kin_primary_contact' => 'required',
            'kin_address' => 'required'
        ]);
        $client=$request->all();
        $client['date_of_birth']=Carbon::parse($request->date_of_birth)->toDateString();
        $client=Clients::create($client);
        if($client) {
            $kinData=[
                'name' => $request->kin_name,
                'identification_document' => $request->kin_identification_document,
                'identification_number' => $request->kin_identification_number,
                'relation' => $request->kin_relation,
                'nationality' => $request->kin_nationality,
                'date_of_birth' => Carbon::parse($request->kin_date_of_birth)->toDateString(),
                'gender' => $request->kin_gender,
                'primary_contact' => $request->kin_primary_contact,
                'alternative_contact'=>$request->kin_alternative_contact,
                'address' => $request->kin_address,
                'client_id'=>$client->id
            ];
            $kin=NextOfKin::create($kinData);
            if(!$kin){
                Clients::delete($client->id);
            }
        }
        return $client;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Clients $clients
     * @return void
     */
    public function show(Clients $clients)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Clients $clients
     * @return void
     */
    public function edit(Clients $clients)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function update(Request $request)
    {
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Clients $clients
     * @return void
     */
    public function destroy(Clients $clients)
    {
        //
    }
}
