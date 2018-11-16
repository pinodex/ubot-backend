<?php

namespace App\Components\Dialogflow\Intents;

use Illuminate\Http\Request;
use App\Components\Ubp\Branch;

class PermissionGetIntent extends BaseIntent
{
    public function handle(Request $request, $parameters)
    {
        $conv = $this->getAgent()->getActionConversation();

        $approved = $conv->getArguments()->get('PERMISSION');

        if ($approved) {
            $latlng = $conv->getDevice()->getLocation()->getCoordinates();
            $lat = $latlng->getLatitude();
            $lng = $latlng->getLongitude();

            $branches = Branch::findNear($lat, $lng);

            $names = [];

            foreach ($branches as $branch) {
                $names[] = $branch->name;
            }

            $this->getAgent()->reply('There are ' . count($branches) . ' branches near you. ' . implode(', ', $names));
        } else {
            $this->getAgent()->reply('I cannot get branches near you without knowing your location');
        }

        //$this->getAgent()->reply($conv);
    }
}
