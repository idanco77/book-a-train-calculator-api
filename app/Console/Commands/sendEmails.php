<?php

namespace App\Console\Commands;

use App\Mail\OrderedTimeShip;
use App\Models\OrderedTime;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
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
        Log::channel('emails')->notice('cronjob begin running' . Carbon::now()->format('d/m/Y H:i:s'));
        $now = Carbon::now()->timestamp;
        $aMinuteAgo = Carbon::now()->subMinute()->timestamp;
        $orderedTimes = OrderedTime::whereBetween('order_timestamp', [$aMinuteAgo, $now])->get();

        foreach ($orderedTimes as $orderedTime) {
            Mail::to($orderedTime->email)
                ->send(new OrderedTimeShip($orderedTime));

            Log::channel('emails')->emergency('email sent to: ' . $orderedTime->id .
                '. Time sent (carbon::now): ' . Carbon::now()->format('d/m/Y H:i:s') .
                '. OrderedTime: (timestamp converted to server local time)' .
                Carbon::parse($orderedTime->orderTimestamp)->format('d/m/Y H:i:s'));
        }

        Log::channel('emails')->info('cronjob finish running. Time is (carbon::now)' .
            Carbon::now()->format('d/m/Y H:i:s') .
        '. orderTime is: ' . Carbon::createFromTimestamp(OrderedTime::first()->order_timestamp)->format('d/m/Y H:i:s'));
    }
}
