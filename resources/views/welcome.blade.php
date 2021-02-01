@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="col-2">
            <div class="card">
                <div class="card-header">Today</div>
                <div class="card-body"><h3 class="text-right"><i class="fa flaticon-users mr-5" style="font-size: 50px;"></i>{{$stats['clients']['today']}}</h3></div>
            </div>
        </div>
        <div class="col-2">
            <div class="card">
                <div class="card-header">Yesterday</div>
                <div class="card-body"><h3 class="text-right"><i class="fa flaticon-users mr-5" style="font-size: 50px;"></i>{{$stats['clients']['yesterday']}}</h3></div>
            </div>
        </div>
        <div class="col-2">
            <div class="card">
                <div class="card-header">This Week</div>
                <div class="card-body"><h3 class="text-right"><i class="fa flaticon-users mr-5" style="font-size: 50px;"></i>{{$stats['clients']['week']}}</h3></div>
            </div>
        </div>
        <div class="col-2">
            <div class="card">
                <div class="card-header">This Month</div>
                <div class="card-body"><h3 class="text-right"><i class="fa flaticon-users mr-5" style="font-size: 50px;"></i>{{$stats['clients']['month']}}</h3></div>
            </div>
        </div>
        <div class="col-2">
            <div class="card">
                <div class="card-header">This Year</div>
                <div class="card-body"><h3 class="text-right"><i class="fa flaticon-users mr-5" style="font-size: 50px;"></i>{{$stats['clients']['year']}}</h3></div>
            </div>
        </div>
    </div>
@endsection
