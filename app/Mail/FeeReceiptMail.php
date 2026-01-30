<?php

namespace App\Mail;

use App\Models\Fee;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeeReceiptMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $fee;

    public function __construct(Fee $fee)
    {
        $this->fee = $fee;
    }

    public function build()
    {
        // relation load
        $this->fee->load('student.room');

        // PDF generate
        $pdf = Pdf::loadView('fees.receipt-pdf', [
            'fee' => $this->fee,
            'amountInWords' => \App\Helpers\NumberToWords::convert(
                $this->fee->paid_fees
            ),
        ]);

        return $this->subject('Fee Receipt - Smart Hostel')
            ->view('emails.fee-receipt')
            ->attachData(
                $pdf->output(),
                'Fee_Receipt_' . $this->fee->id . '.pdf',
                [
                    'mime' => 'application/pdf',
                ]
            );
    }
}