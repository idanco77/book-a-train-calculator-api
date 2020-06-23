<?php

namespace App\Http\Controllers;

use App\Models\OrderedTime;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderedTimeController extends Controller
{
    public function email(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
            'departureTimestamp' => ['required', 'numeric'],
            'orderedTimestamp' => ['required', 'numeric']
        ]);

       OrderedTime::create([
            'email' => $request->email,
            'departure_timestamp' => $request->departureTimestamp,
            'order_timestamp' => $request->orderedTimestamp,
        ]);

        return response()->json(['message' => 'saved successfully'], 200);
    }
}
