<?php

namespace App\Http\Controllers;

use App\Charts\LoanApplicationChart;
use App\Clients;
use App\LoanApplication;
use App\Product;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $data=(new DashboardController())->stats();

        $productStatuses=['APPROVED','PENDING','DISBURSED','REJECTED','SETTLED'];

        $chartData=collect([]);
        $loansAmount=collect([]);
        $loansProductAmount=collect([]);
        $loansProductAmountApproved=collect([]);
        $loansProductAmountDisbursed=collect([]);
        $interestPerProduct=collect([]);
        $clients=collect([]);
        $productStatus=collect([]);
        $days=collect([]);
        $daysClients=collect([]);
        $productLabels=collect([]);
        $statusLabels=collect([]);

        for ($days_backwards = 30; $days_backwards >= 0; $days_backwards--) {
            // Could also be an array_push if using an array rather than a collection.
            $chartData->push(LoanApplication::whereDate('created_at', today()->subDays($days_backwards))->count());
            $loansAmount->push(LoanApplication::whereDate('created_at', today()->subDays($days_backwards))->sum('amount_applied'));
            $clients->push(Clients::whereDate('created_at', today()->subDays($days_backwards))->count());
            $days->push(today()->subDays($days_backwards)->toDateString());
        }

        for ($days_backwards = 7; $days_backwards >= 0; $days_backwards--) {
            // Could also be an array_push if using an array rather than a collection.
            $clients->push(Clients::whereDate('created_at', today()->subDays($days_backwards))->count());
            $daysClients->push(today()->subDays($days_backwards)->toDateString());
        }

        $products=Product::all();
        $productColors=[];
        $productColors1=[];
        $productColors2=[];
        $productColors3=[];
        $productColors4=[];
        foreach ($products as $product) {
            $loansProductAmount->push(LoanApplication::where('product_id',$product->id)->sum('amount_applied'));
            $loansProductAmountApproved->push(LoanApplication::where('product_id',$product->id)->sum('amount_approved'));
            $loansProductAmountDisbursed->push(LoanApplication::where('product_id',$product->id)->where('status','DISBURSED')->sum('amount_approved'));
            $interestPerProduct->push(LoanApplication::where('product_id',$product->id)->sum('total_interest'));
            $productLabels->push($product->name.' ('.$product->code.')');
            $productColors[]=sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $productColors1[]=sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $productColors2[]=sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $productColors3[]=sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        }

        foreach ($productStatuses as $productStatusItem) {
            $productStatus->push(LoanApplication::where('status',$productStatusItem)->count());
            $statusLabels->push($productStatusItem);
            if($productStatusItem=='DISBURSED') {
                $productColors4[]='blue';
            }
            if($productStatusItem=='PENDING') {
                $productColors4[]='gray';
            }
            if($productStatusItem=='APPROVED') {
                $productColors4[]='purple';
            }
            if($productStatusItem=='REJECTED') {
                $productColors4[]='red';
            }
            if($productStatusItem=='SETTLED') {
                $productColors4[]='green';
            }
        }


        $chart=new LoanApplicationChart;
        $chart->title('Loans Chart');
        $chart->labels($days);
        $chart->dataset('Loans Requests', 'line', $chartData);

        $pieChart=new LoanApplicationChart;
        $pieChart->title('Products Amount Applied Chart');
        $pieChart->labels($productLabels);
        $pieChart->dataset('Applied Amount','pie',$loansProductAmount)->options([
            'color'=>$productColors,
        ]);

        $approvedAmounts=new LoanApplicationChart;
        $approvedAmounts->title('Products Amount Approved Chart');
        $approvedAmounts->labels($productLabels);
        $approvedAmounts->dataset('Approved Amount','pie',$loansProductAmountApproved)->options([
            'color'=>$productColors1
        ]);

        $disbursedAmounts=new LoanApplicationChart;
        $disbursedAmounts->title('Products Amount Disbursed Chart');
        $disbursedAmounts->labels($productLabels);
        $disbursedAmounts->dataset('Disbursed Amount','pie',$loansProductAmountDisbursed)->options([
            'color'=>$productColors2
        ]);

        $productInterests=new LoanApplicationChart;
        $productInterests->title('Interest per product');
        $productInterests->labels($productLabels);
        $productInterests->dataset('Interest Amount','pie',$interestPerProduct)->options([
            'color'=>$productColors3
        ]);

        $prodStatus=new LoanApplicationChart;
        $prodStatus->title('Loan Status');
        $prodStatus->labels($statusLabels);
        $prodStatus->dataset('Status','pie',$productStatus)->options([
            'color'=>$productColors4
        ]);


        $clientChart=new LoanApplicationChart;
        $clientChart->title('Clients');
        $clientChart->labels($daysClients);
        $clientChart->dataset('Clients','line',$clients)->options([
            'color'=>'purple',
        ]);

        return view('welcome',[
            'stats'=>$data,
            'chart'=>$chart,
            'products_applied'=>$pieChart,
            'approved'=>$approvedAmounts,
            'disbursed'=>$disbursedAmounts,
            'interestProduct'=>$productInterests,
            'status'=>$prodStatus,
            'clients'=>$clientChart,
        ]);
    }
}
