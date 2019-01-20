<?php

namespace CoffeeMachine\Models;

class Chocolate extends Drink
{
    /**
     * Define the price of a chocolate drink
     */
    const PRICE = 5;


    /**
     * Chocolate constructor.
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