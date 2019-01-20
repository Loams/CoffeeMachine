<?php


namespace CoffeeMachine\Models;


class Milk extends AbstractConsumable
{
    /**
     * Define the maximum milk Consumable support
     */
    const MAXMILK = 4;
    /**
     * Define the minimum milk Consumable support
     */
    const MINMILK = 0;

    /**
     * Get the maximum Consumable product you can have
     * @return int
     */
    public function getMax(): int
    {
        return self::MAXMILK;
    }

    /**
     * Get the minimum Consumable product you can have
     * @return int
     */
    public function getMin(): int
    {
        return self::MINMILK;
    }
}