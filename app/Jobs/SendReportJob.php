<?php

namespace App\Jobs;

use App\Mail\SendReportMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $sales_amount;
    protected $list_sellers;

    /**
     * Create a new job instance.
     *
     * @param $sales_amount
     * @param $list_sellers
     */
    public function __construct($sales_amount, $list_sellers)
    {
        $this->sales_amount = $sales_amount;
        $this->list_sellers = $list_sellers;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(
            new SendReportMail($this->sales_amount, $this->list_sellers)
        );
    }
}














