<?php

namespace CoffeeMachine\Models;

class Coffee extends Drink
{
    /**
     * Define the price of a coffee drink
     */
    const PRICE = 2;

    /**
     * Coffee constructor.
     *
     * @param Sugar $sugar
     * @param Milk  $milk
     */
    public function __construct(Sugar $sugar, Milk $milk)
    {
        parent::__construct($sugar, $milk);
        $this->price = self::PRICE;
    }
}