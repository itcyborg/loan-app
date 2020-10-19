<?php

namespace App\Http\Controllers;

use App\Clients;
use App\DataTables\ClientsDataTable;
use App\NextOfKin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\DataTables;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\DataTables\ClientsDataTable $dataTable
     * @return \App\Clients[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index(ClientsDataTable $dataTable)
    {
        $clients= Cache::remember('clients',150,function(){
            return Clients::all();
        });
        if (request()->ajax()) {
            return DataTables::of($clients)
                ->editColumn('created_at', function (Clients $clients){
                    return \Illuminate\Support\Carbon::parse($clients->created_at)->toFormattedDateString();
                })
                ->editColumn('updated_at',function (Clients $clients){
                    return Carbon::parse($clients->updated_at)->toFormattedDateString();
                })
                ->editColumn('date_of_birth',function (Clients $clients){
                    return Carbon::parse($clients->date_of_birth)->toFormattedDateString();
                })->toJson();
        }

        return $dataTable->render('superadministrator.clients');
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
        ]);
        $client=$request->all();

        try{
            $client['date_of_birth']=Carbon::parse($request->date_of_birth)->toDateString();
            Clients::create($client);
            notify()->success('Client successfully added');
        }catch (\Throwable $e){
            notify()->error('An error occurred adding the client');
        }
        return redirect()->route('client.index');
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

    public function info(Request  $request)
    {
        $this->validate($request,['id'=>'required']);
        return Clients::findOrFail($request->id)->toJson();
    }
}
