<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Components\Ubp\Ubp;

class AuthController extends Controller
{
    /**
     * Login API action
     *
     * @param  Ubp    $ubp Ubp instance
     * @return array
     */
    public function login(Ubp $ubp)
    {
        $uri = $ubp->getLoginUri();

        return [
            'redirect_uri' => $uri
        ];
    }

    /**
     * Oauth code handler
     *
     * @return mixed
     */
    public function oauth(Request $request, Ubp $ubp)
    {
        $code = $request->input('code');

        //return $ubp->obtainAccessToken($code);
    }
}
