<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\SendReportJob;
use App\Models\Sale\Sale;
use App\Models\Seller\Seller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleReportController extends Controller
{
    public function dailyReport(): array
    {
        $sales = Sale::query()
            ->with('seller')
            ->whereDate('created_at', Carbon::today())
            ->get();

        $sales = $sales->groupBy('seller_id')->values();

        $sellers = collect($sales)->map(function ($sale){

            $amount = $sale->sum('amount');

            return [
                'name' => $sale[0]['seller']['name'],
                'amount_format' => 'R$ '.number_format(round((float)$amount,2),2),
                'amount' => $amount
            ];
        });

        $sales_amount = number_format(round((float)$sellers->sum('amount'),2),2);

        return[
            'sales_amount' => $sales_amount,
            'sellers' => $sellers,
        ];
    }
}
