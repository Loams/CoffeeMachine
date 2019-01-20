<?php

namespace CoffeeMachine\Models;

class Tea extends Drink
{
    /**
     * Define the price of a Tea drink
     */
    const PRICE = 3;

    /**
     * Tea constructor.
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