<?php

namespace App\Console\Commands;

use App\Http\Controllers\API\SaleReportController;
use App\Jobs\SendReportJob;
use Facade\FlareClient\Report;
use Illuminate\Console\Command;

class SendSalesReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:SalesReport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send sales report daily';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $report = new SaleReportController();
        $daily_report = $report->dailyReport();
        SendReportJob::dispatch($daily_report['sales_amount'], $daily_report['sellers']);
    }
}
