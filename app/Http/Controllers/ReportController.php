<?php

namespace App\Http\Controllers;

use App\ChargeIncome;
use App\LoanApplication;
use App\Product;
use App\Report;
use App\Revenue;
use App\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('reports.reports');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }

    public function getData(Request $request)
    {
        $disbursements=LoanApplication::with('product')
            ->groupBy('product_id')
            ->where('status','DISBURSED')
            ->selectRaw('sum(amount_approved) as amount_approved_sum,sum(amount_applied) as amount_applied_sum,product_id')
            ->get();
        $principals=LoanApplication::with('product')
            ->groupBy('product_id')
            ->where('status','APPROVED')
            ->orWhere('status','DISBURSED')
            ->selectRaw('sum(amount_approved) as amount_approved_sum,sum(amount_applied) as amount_applied_sum,product_id')
            ->get();
        $interest=LoanApplication::with('product')
            ->groupBy('product_id')
            ->where('status','APPROVED')
            ->orWhere('status','DISBURSED')
            ->selectRaw('sum(total_interest) as total_interest,product_id')
            ->get();
        $income=Revenue::with('user')->where('category','income')
            ->get();
        $expense=Revenue::with('user')->where('category','expense')
            ->get();
        $chargesIncome=ChargeIncome::with('product')->get();
        return [
            'disbursement'=>$disbursements,
            'principals'=>$principals,
            'interest'=>$interest,
            'income'=>$income,
            'income_sum'=>$income->sum('amount'),
            'expense'=>$expense,
            'expense_sum'=>$expense->sum('amount'),
            'charges'=>$chargesIncome
        ];
    }

    public function getAgentReports(Request $request)
    {
//        $this->validate($request,[
//           'agent_id'=>'required',
//        ]);

        /**
         * Steps
         * 1. get the summary of each agent
         * 2. get the details of each agent
         */

        // step 1
        $interest=LoanApplication::with(['product','user','officer'])->get();
        $agents=User::all();
        $products=Product::all();
        return json_encode(['reports'=>$interest,'products'=>$products,'agents'=>$agents,'loan_officers'=>$agents]);
    }
}
