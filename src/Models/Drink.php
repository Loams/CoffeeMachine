<?php

namespace CoffeeMachine\Models;


class Drink extends AbstractDrink
{
    /**
     * @var Sugar
     */
    protected $sugar;
    /**
     * @var Milk
     */
    protected $milk;

    /**
     * Drink constructor.
     *
     * @param Sugar $sugar
     * @param Milk $milk
     */
    public function __construct(Sugar $sugar, Milk $milk)
    {
        $this->sugar = $sugar;
        $this->milk = $milk;
    }

    /**
     * Get total milk
     *
     * @return int
     */
    public function getMilk(): int
    {
        return $this->milk->getTotal();
    }

    /**
     * Get total sugar
     *
     * @return int
     */
    public function getSugar(): int
    {
        return $this->sugar->getTotal();
    }
}