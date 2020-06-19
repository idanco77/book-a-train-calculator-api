<?php

namespace App\Jobs;

use App\Mail\OrderedTimeShip;
use App\Models\OrderedTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderedTime;

    /**
     * Create a new job instance.
     *
     * @param OrderedTime $orderedTime
     */
    public function __construct(OrderedTime $orderedTime)
    {
        $this->orderedTime = $orderedTime;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return Mail::to($this->orderedTime->email)
            ->later($this->orderedTime->ordered_time, new OrderedTimeShip());
    }
}
