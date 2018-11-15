<?php

namespace App\Components\Dialogflow\Intents;

use Illuminate\Http\Request;

abstract class BaseIntent
{
    /**
     * Agent
     * @var Agent
     */
    private $agent;

    /**
     * Agent
     * @param Agent $agent Agent
     */
    public function __construct($agent)
    {
        $this->agent = $agent;
    }

    /**
     * Agent
     * @return Agent Angent
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * Handle action for intent
     *
     * @param Request $request Request object
     * @param  array $parameters Paramters for intent
     * @return mixed
     */
    abstract function handle(Request $request, $parameters);
}
