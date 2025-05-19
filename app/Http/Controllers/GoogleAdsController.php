<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Click;

class GoogleAdsController extends Controller
{
    public function testPost(Request $request)
    {
        return response()->json(['message' => 'Authenticated and received POST data', 'data' => $request->all()]);
    }

    public function allClicks()
    {
        return response()->json(Click::all());
    }

    public function addClick(Request $request)
    {
        $gclid = $request['gclid'];

        // Check first if this GCLID exists in the `clicks` table
        $result = Click::where('gclid', $gclid)->first();
        if ($result) { // Do not insert, GCLID already exists
            return response()->json([
                'message' => "GCLID `{$gclid}` already exists!"
            ]);
        }

        // Insert to `clicks` table
        $result = Click::create([
            'gclid' => $gclid,
            'resource_name' => $request['resource_name'],
            'group_ad' => $request['group_ad'],
            'group_name' => $request['group_name'],
            'group_id' => $request['group_id'],
            'date_time' => $request['date_time'],
            'account_id' => $request['account_id'],
            'account_name' => $request['account_name'],
            'date_time_no_timezone' => $request['date_time_no_timezone'],
            'conversion_name' => $request['conversion_name'],
        ]);

        return response()->json(['id' => $result->id]);
    }
}
