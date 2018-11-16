<?php

namespace App\Components\Dialogflow\Intents;

use Illuminate\Http\Request;
use Dialogflow\Action\Questions\Permission;

class BranchLocatorIntent extends BaseIntent
{
    public function handle(Request $request, $parameters)
    {
        $conv = $this->getAgent()->getActionConversation();

        $conv->ask(Permission::create('To address you by your location', ['DEVICE_PRECISE_LOCATION']));

        $this->getAgent()->reply($conv);
    }
}
