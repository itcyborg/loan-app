<?php

namespace App\Http\Controllers;

use App\Charts\LoanApplicationChart;
use App\Clients;
use App\LoanApplication;
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

        $stats['applications']['today']=LoanApplication::whereBetween('created_at',[$dateSOT,$dateEOT])->count();
        $stats['applications']['yesterday']=LoanApplication::whereBetween('created_at',[$dateSOY,$dateEOY])->count();
        $stats['applications']['week']=LoanApplication::whereBetween('created_at',[$dateSOW,$dateEOW])->count();
        $stats['applications']['month']=LoanApplication::whereBetween('created_at',[$dateSOM,$dateEOM])->count();
        $stats['applications']['year']=LoanApplication::whereBetween('created_at',[$dateSOYr,$dateEOYr])->count();

        $stats['applications_applied']['today']=LoanApplication::whereBetween('created_at',[$dateSOT,$dateEOT])->sum('amount_applied');
        $stats['applications_applied']['yesterday']=LoanApplication::whereBetween('created_at',[$dateSOY,$dateEOY])->sum('amount_applied');
        $stats['applications_applied']['week']=LoanApplication::whereBetween('created_at',[$dateSOW,$dateEOW])->sum('amount_applied');
        $stats['applications_applied']['month']=LoanApplication::whereBetween('created_at',[$dateSOM,$dateEOM])->sum('amount_applied');
        $stats['applications_applied']['year']=LoanApplication::whereBetween('created_at',[$dateSOYr,$dateEOYr])->sum('amount_applied');

        $stats['applications_approved']['today']=LoanApplication::whereBetween('created_at',[$dateSOT,$dateEOT])->sum('amount_approved');
        $stats['applications_approved']['yesterday']=LoanApplication::whereBetween('created_at',[$dateSOY,$dateEOY])->sum('amount_approved');
        $stats['applications_approved']['week']=LoanApplication::whereBetween('created_at',[$dateSOW,$dateEOW])->sum('amount_approved');
        $stats['applications_approved']['month']=LoanApplication::whereBetween('created_at',[$dateSOM,$dateEOM])->sum('amount_approved');
        $stats['applications_approved']['year']=LoanApplication::whereBetween('created_at',[$dateSOYr,$dateEOYr])->sum('amount_approved');

        return $stats;
    }
}
