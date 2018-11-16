<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Components\Ubp\Branch;

class BranchController extends Controller
{
    public function locate(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        return Branch::findNear($latitude, $longitude);
    }
}
