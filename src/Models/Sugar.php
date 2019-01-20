<?php

namespace CoffeeMachine\Models;


class Sugar extends AbstractConsumable
{
    /**
     * Define the maximum sugar Consumable support
     */
    const MAXSUGAR = 4;
    /**
     * Define the minimum sugar Consumable support
     */
    const MINSUGAR = 0;

    /**
     * Get the maximum Consumable product you can have
     *
     * @return int
     */
    public function getMax(): int
    {
        return self::MAXSUGAR;
    }

    /**
     * Get the minimum Consumable product you can have
     *
     * @return int
     */
    public function getMin(): int
    {
        return self::MINSUGAR;
    }
}