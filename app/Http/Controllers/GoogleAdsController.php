<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoogleAdsController extends Controller
{
    public function testPost(Request $request)
    {
        return response()->json(['message' => 'Authenticated and received POST data', 'data' => $request->all()]);
    }
}
