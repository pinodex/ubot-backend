<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Components\Ubp\Forex\Conversion;
use App\Components\Ubp\Forex;

class ForexController extends Controller
{
    public function convert(Request $request, Forex $forex)
    {
        $data = $request->only(['source', 'destination', 'amount']);

        $result = $forex->convert($data['source'], $data['destination'], $data['amount']);

        if ($result instanceof Conversion) {
            return $result->toArray();
        }

        return response()->json([
            'message' => 'Invalid currency'
        ], 400);
    }
}
