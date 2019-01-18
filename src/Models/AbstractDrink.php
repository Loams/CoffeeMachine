<?php

namespace CoffeeMachine\Models;


use CoffeeMachine\Interfaces\DrinkInterface;

abstract class AbstractDrink implements DrinkInterface
{
    /**
     * @var int
     */
    public $price;

    /**
     * Get the price of a Drink
     *
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }
}