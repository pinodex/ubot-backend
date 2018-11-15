<?php

namespace App\Components\Dialogflow\Intents;

use Illuminate\Http\Request;
use App\Components\Ubp\Forex;
use App\Components\Ubp\Forex\Conversion;

class CurrencyConversionIntent extends BaseIntent
{
    public function handle(Request $request, $parameters)
    {
        $forex = app()->make(Forex::class);

        $conversion = $forex->convert(
            $parameters['source'], $parameters['destination'], $parameters['amount']);

        if ($conversion instanceof Conversion) {
            $this->getAgent()->reply(sprintf('%.2f %s is %s %s',
                $conversion->getAmount(),
                $conversion->getSource(),
                rtrim(number_format($conversion->getValue(), 3),'.0'),
                $conversion->getDestination()
            ));
        }
    }
}
