<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Call;

class CallsController extends Controller
{
    public function allCalls()
    {
        return response()->json(Call::all());
    }

    public function addCall(Request $request)
    {
        $rowsInserted = Call::insertOrIgnore([
            'contact_id' => $request['contactId'],
            'location_id' => $request['locationId'],
            'timestamp' => $request['timestamp'],
            'conversation_id' => $request['conversationId'],
        ]);

        return response()->json(['added_calls' => $rowsInserted]);
    }
}
