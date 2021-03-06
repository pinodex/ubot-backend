<?php

namespace App\Components\Dialogflow;

use App\Components\Dialogflow\Intents;

class Manager
{
    /**
     * Intents
     * @var array
     */
    private $intents = [
        'currency.conversion' => Intents\CurrencyConversionIntent::class,
        'branch.locator' => Intents\BranchLocatorIntent::class,
        'permission_get' => Intents\PermissionGetIntent::class
    ];

    /**
     * Get intent for action
     *
     * @param  string $action Action name
     * @return string
     */
    public function getIntentForAction($action)
    {
        return $this->intents[$action];
    }
}
