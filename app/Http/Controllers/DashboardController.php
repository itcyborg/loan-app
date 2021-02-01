<?php

namespace App\Http\Controllers;

use App\Clients;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function stats()
    {
        $dateSOT = Carbon::now()->startOfDay();
        $dateEOT = Carbon::now()->endOfDay();
        $dateSOY = Carbon::now()->startOfDay()->subDays(1);
        $dateEOY = Carbon::now()->endOfDay()->subDays(1);
        $dateSOW = Carbon::now()->startOfWeek();
        $dateEOW = Carbon::now()->endOfWeek();
        $dateSOM = Carbon::now()->startOfMonth();
        $dateEOM = Carbon::now()->endOfMonth();
        $dateSOYr = Carbon::now()->startOfYear();
        $dateEOYr = Carbon::now()->endOfYear();

        $stats=[];

        $stats['clients']['today']=Clients::whereBetween('created_at',[$dateSOT,$dateEOT])->count();
        $stats['clients']['yesterday']=Clients::whereBetween('created_at',[$dateSOY,$dateEOY])->count();
        $stats['clients']['week']=Clients::whereBetween('created_at',[$dateSOW,$dateEOW])->count();
        $stats['clients']['month']=Clients::whereBetween('created_at',[$dateSOM,$dateEOM])->count();
        $stats['clients']['year']=Clients::whereBetween('created_at',[$dateSOYr,$dateEOYr])->count();

        return $stats;
    }
}
