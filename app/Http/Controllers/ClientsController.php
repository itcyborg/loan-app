<?php

namespace App\Http\Controllers;

use App\Clients;
use App\DataTables\ClientsDataTable;
use App\NextOfKin;
use Carbon\Carbon;
use Exception;
use http\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Throwable;
use Yajra\DataTables\DataTables;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Clients[]|Application|Factory|Collection|Response|View
     */
    public function index()
    {
        return view('superadministrator.clients',['clients'=>Clients::all()]);
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
     * @param Request $request
     *
     * @return Response
     * @throws Exception
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
        }catch (Throwable $e){
            notify()->error('An error occurred adding the client');
        }
        return redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Clients $clients
     *
     * @return Clients|void
     */
    public function show($id)
    {
        $clients=Clients::findOrFail($id);
        return $clients;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Clients $clients
     *
     * @return void
     */
    public function edit(Clients $clients)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return array
     */
    public function update(Request $request,$id)
    {
        $client=Clients::findOrFail($id);
        return $client->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Clients $clients
     *
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
