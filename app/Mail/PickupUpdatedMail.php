<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PickupUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pickup;

    public function __construct($pickup)
    {
        $this->pickup = $pickup;
    }

    public function build()
    {
        return $this->subject('Your Pickup Details Updated')
                    ->view('emails.pickup_updated')
                    ->with([
                        'totalWeight' => $this->pickup->total_weight,
                        'amountPaid' => $this->pickup->amount_paid,
                        'status' => $this->pickup->status,
                    ]);
    }
}
