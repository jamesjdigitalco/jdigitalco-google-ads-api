<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Click;

class GoogleAdsController extends Controller
{
    public function testPost(Request $request)
    {
        return response()->json(
            ['message' => 'Authenticated and received POST data', 'data' => $request->all()]
        );
    }

    public function allClicks(Request $request)
    {
        if ($request->query('all') === 'true') {
            return response()->json(Click::all());
        }

        return response()->json(
            Click::select('id', 'gclid', 'account_id', 'account_name')->get()
        );
    }

    public function addClick(Request $request)
    {
        $gclid = $request['gclid'];

        // Check first if this GCLID exists in the `clicks` table
        $result = Click::where('gclid', $gclid)->first();
        if ($result) { // Do not insert, GCLID already exists
            return response()->json([
                'message' => "INSERT FAILED: GCLID `{$gclid}` already exists!"
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
            'segments_date' => $request['segments_date'],
            'account_id' => $request['account_id'],
            'account_name' => $request['account_name'],
            'date_time_no_timezone' => $request['date_time_no_timezone'],
            'conversion_action_name' => $request['conversion_action_name'],
        ]);

        return response()->json(['id' => $result->id]);
    }

    public function getClicks(Request $request)
    {
        $gclid = $request['gclid'] ?? '';
        $accountId = $request['account_id'] ?? '';
        $accountName = $request['account_name'] ?? '';
        $groupAd = $request['group_ad'] ?? '';
        $groupName = $request['account_name'] ?? '';
        $startDatetime = $request['start_datetime'] ?? '';
        $endDatetime = $request['end_datetime'] ?? '';

        $query = Click::query();
        if ($gclid) {
            $query = $query->where('gclid', $gclid);
        }
        if ($accountId) {
            $query = $query->where('account_id', $accountId);
        }
        if ($accountName) {
            $query = $query->where('account_name', $accountName);
        }
        if ($groupAd) {
            $query = $query->where('group_ad', $groupAd);
        }
        if ($groupName) {
            $query = $query->where('group_name', $groupName);
        }
        if ($startDatetime && $endDatetime) {
            $query = $query->whereBetween('date_time_no_timezone', [$startDatetime, $endDatetime]);
        }

        return response()->json($query->get());
    }

    public function addBulkJsonClicks(Request $request)
    {
        $longIncompleteJsonString = urldecode($request->payload ?? '');
        $correctJsonString = "[" . substr($longIncompleteJsonString, 0, -1) . "]";
        $arrayOfClicks = json_decode($correctJsonString);

        $returnGclids = [];
        foreach ($arrayOfClicks as $click) {
            // Check first if this GCLID exists in the `clicks` table
            $result = Click::where('gclid', $click->gclid)->first();
            if (!$result) { // Insert if gclid does not exists in `clicks` table
                $returnGclids[] = $click->gclid;
                // Insert to `clicks` table
                $result = Click::create([
                    'gclid' => $click->gclid,
                    'resource_name' => $click->resource_name,
                    'group_ad' => $click->group_ad,
                    'group_name' => $click->group_name,
                    'group_id' => $click->group_id,
                    'date_time' => $click->date_time,
                    'segments_date' => $click->segments_date,
                    'account_id' => $click->account_id,
                    'account_name' => $click->account_name,
                    'date_time_no_timezone' => $click->date_time_no_timezone,
                    'conversion_action_name' => $click->conversion_action_name,
                ]);
            }
        }

        return response()->json([
            'total_inserted_gclids' => count($returnGclids),
            'ids' => $returnGclids
        ]);
    }
}
