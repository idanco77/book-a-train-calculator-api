<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmails;
use App\Models\OrderedTime;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderedTimeController extends Controller
{
    public function email(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
            'orderedTime' => ['required', 'numeric']
        ]);

        $orderedTime = OrderedTime::create([
            'email' => $request->email,
            'order_open_time_utc' => Carbon::createFromTimestamp($request->orderedTime),
            'order_open_time_israel' => Carbon::createFromTimestamp($request->orderedTime, 3),
            'departure_time_israel' => Carbon::createFromTimestamp($request->orderedTime, 3)->addHours(85),
        ]);

        $this->dispatch(new SendEmails($orderedTime));

        return response()->json(['message' => 'email sent successfully'], 200);
    }
}
