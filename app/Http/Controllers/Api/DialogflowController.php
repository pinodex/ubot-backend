<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Components\Dialogflow\Manager;

class DialogflowController extends Controller
{
    public function webhook(Request $request, Manager $manager)
    {
        $agent = \Dialogflow\WebhookClient::fromData($request->json()->all());

        $action = $agent->getAction();
        $intentClass = $manager->getIntentForAction($action);

        $intent = new $intentClass($agent);

        $intent->handle($request, $agent->getParameters());

        return response()->json($agent->render());
    }
}
