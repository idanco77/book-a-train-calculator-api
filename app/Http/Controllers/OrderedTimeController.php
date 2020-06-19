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
            'orderedTime' => ['required', 'string']
        ]);

        $orderedTime = OrderedTime::create([
            'email' => $request->email,
            'ordered_time' => Carbon::createFromTimestamp($request->orderedTime, 3)
        ]);

        $this->dispatch(new SendEmails($orderedTime));

        return response()->json(['message' => 'email sent successfully'], 200);
    }
}
