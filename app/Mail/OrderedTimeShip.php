<?php

namespace App\Mail;

use App\Models\OrderedTime;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class OrderedTimeShip extends Mailable
{
    use Queueable, SerializesModels;

    protected $orderedTime;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(OrderedTime $orderedTime)
    {
        $this->orderedTime = $orderedTime;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $departureTimestamp = Carbon::createFromTimestamp($this->orderedTime->departure_timestamp)
            ->timezone(3)
            ->format('d/m/Y H:i:s');
        return $this->subject('email sent')->markdown('email')->with('departureTimestamp', $departureTimestamp);
    }
}
