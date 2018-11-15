<?php

namespace App\Components\Ubp\Forex;

class Conversion
{
    /**
     * Source currency symnol
     * @var string
     */
    private $source;

    /**
     * Destination currency symbol
     * @var string
     */
    private $destination;

    /**
     * Source Amount
     * @var double
     */
    private $amount;

    /**
     * Destination value
     * @var double
     */
    private $value;

    /**
     * Conversion rate used
     * @var double
     */
    private $rate;

    /**
     * Date of conversion data
     * @var string
     */
    private $date;

    public function __construct($source, $destination, $amount, $value, $rate, $date)
    {
        $this->source = $source;

        $this->destination = $destination;

        $this->amount = $amount;

        $this->value = $value;

        $this->rate = $rate;

        $this->date = $date;
    }

    public function getSource()
    {
        return $this->source;
    }

    public function getDestination()
    {
        return $this->destination;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getRate()
    {
        return $this->rate;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function toArray()
    {
        return [
            'source' => $this->source,
            'destination' => $this->destination,
            'amount' => $this->amount,
            'value' => $this->value,
            'rate' => $this->rate,
            'date' => $this->date
        ];
    }
}
