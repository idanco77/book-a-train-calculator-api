<?php

namespace App\Jobs;

use App\Mail\OrderedTimeShip;
use App\Models\OrderedTime;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderedTime;

    /**
     * Create a new job instance.
     *
     * @param
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $now = Carbon::now();
        OrderedTime::whereBetween('order_open_time_utc', $now, $now - 60)->get();

        $info = Mail::to($this->orderedTime->email)
            ->later(Carbon::parse($this->orderedTime->order_open_time_utc), new OrderedTimeShip($this->orderedTime));
        Log::info($info);
        return $info;
    }
}
