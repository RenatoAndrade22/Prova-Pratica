<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendReportMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $sales_amount;

    protected $list_sellers;

    /**
     * Create a new message instance.
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('emails.reports.sales_report', [
                'sales_amount' => $this->sales_amount,
                'list_sellers' => $this->list_sellers,
            ])->subject('Relatório do dia - Vendas');
    }
}
