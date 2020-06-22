<?php

namespace App\Console\Commands;

use App\Mail\OrderedTimeShip;
use App\Models\OrderedTime;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class sendEmails extends Command
{
    protected $signature = 'send:emails';

    protected $description = 'sending emails 48 hours before order opens';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now()->toDateTimeString();
        $aMinuteAgo = Carbon::now()->subMinute()->toDateTimeString();
        $orderedTimes = OrderedTime::whereBetween('order_open_time_utc', [$aMinuteAgo, $now])->get();

        foreach ($orderedTimes as $orderedTime) {
            Mail::to($orderedTime->email)
                ->send(new OrderedTimeShip($orderedTime));
        }
    }
}
