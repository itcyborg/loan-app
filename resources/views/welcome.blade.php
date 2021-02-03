@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="card w-100">
            <div class="card-body">
                {!! $chart->container() !!}
            </div>
        </div>
    </div>
    <div class="row w-100">
        <div class="col-4">
            <div class="card w-100">
                <div class="card-body">
                    {!! $products_applied->container() !!}
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card w-100">
                <div class="card-body">
                    {!! $approved->container() !!}
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card w-100">
                <div class="card-body">
                    {!! $disbursed->container() !!}
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card w-100">
                <div class="card-body">
                    {!! $interestProduct->container() !!}
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card w-100">
                <div class="card-body">
                    {!! $status->container() !!}
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card w-100">
                <div class="card-body">
                    {!! $clients->container() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Clients</h5>
                            <span class="h6 mb-0 w-50">Today</span> <span class="text-success pull-right w-50">{{$stats['clients']['today']}}</span><br>
                            <span class="h6 mb-0 w-50">Yesterday </span><span class="text-success pull-right w-50">{{$stats['clients']['yesterday']}}</span><br>
                            <span class="h6 mb-0 w-50">Week </span><span class="text-success pull-right w-50">{{$stats['clients']['week']}}</span><br>
                            <span class="h6 mb-0 w-50">Month </span><span class="text-success pull-right w-50">{{$stats['clients']['month']}}</span><br>
                            <span class="h6 mb-0 w-50">Year </span><span class="text-success pull-right w-50">{{$stats['clients']['year']}}</span><br>
                        </div>
                        <div class="col-auto">
                            <div class="text-success rounded bg-white">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Applications</h5>
                            <span class="h6 mb-0 w-50">Today</span> <span class="text-success pull-right w-50">{{$stats['applications']['today']}}</span><br>
                            <span class="h6 mb-0 w-50">Yesterday </span><span class="text-success pull-right w-50">{{$stats['applications']['yesterday']}}</span><br>
                            <span class="h6 mb-0 w-50">Week </span><span class="text-success pull-right w-50">{{$stats['applications']['week']}}</span><br>
                            <span class="h6 mb-0 w-50">Month </span><span class="text-success pull-right w-50">{{$stats['applications']['month']}}</span><br>
                            <span class="h6 mb-0 w-50">Year </span><span class="text-success pull-right w-50">{{$stats['applications']['year']}}</span><br>
                        </div>
                        <div class="col-auto">
                            <div class="text-success rounded bg-white">
                                <i class="fa fa-clipboard fa-5x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Amount Applied</h5>
                            <span class="h6 mb-0 w-50">Today</span> <span class="text-info pull-right w-50">{{$stats['applications_applied']['today']}}</span><br>
                            <span class="h6 mb-0 w-50">Yesterday </span><span class="text-info pull-right w-50">{{$stats['applications_applied']['yesterday']}}</span><br>
                            <span class="h6 mb-0 w-50">Week </span><span class="text-info pull-right w-50">{{$stats['applications_applied']['week']}}</span><br>
                            <span class="h6 mb-0 w-50">Month </span><span class="text-info pull-right w-50">{{$stats['applications_applied']['month']}}</span><br>
                            <span class="h6 mb-0 w-50">Year </span><span class="text-info pull-right w-50">{{$stats['applications_applied']['year']}}</span><br>
                        </div>
                        <div class="col-auto">
                            <div class="text-info rounded bg-white">
                                <i class="fa flaticon-coins fa-5x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0 text-nowrap">Approved</h5>
                            <span class="h6 mb-0 w-50">Today</span> <span class="text-info pull-right w-50">{{$stats['applications_approved']['today']}}</span><br>
                            <span class="h6 mb-0 w-50">Yesterday </span><span class="text-info pull-right w-50">{{$stats['applications_approved']['yesterday']}}</span><br>
                            <span class="h6 mb-0 w-50">Week </span><span class="text-info pull-right w-50">{{$stats['applications_approved']['week']}}</span><br>
                            <span class="h6 mb-0 w-50">Month </span><span class="text-info pull-right w-50">{{$stats['applications_approved']['month']}}</span><br>
                            <span class="h6 mb-0 w-50">Year </span><span class="text-info pull-right w-50">{{$stats['applications_approved']['year']}}</span><br>
                        </div>
                        <div class="col-auto">
                            <div class="text-info rounded bg-white">
                                <i class="fa flaticon-coins fa-5x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
    {!! $chart->script() !!}
    {!! $products_applied->script() !!}
    {!! $approved->script() !!}
    {!! $disbursed->script() !!}
    {!! $interestProduct->script() !!}
    {!! $status->script() !!}
    {!! $clients->script() !!}
@endsection