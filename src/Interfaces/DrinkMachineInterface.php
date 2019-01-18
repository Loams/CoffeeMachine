<?php

namespace CoffeeMachine\Interfaces;

use CoffeeMachine\Exceptions\HaventEnoughMoney;

Interface DrinkMachineInterface
{
    /**
     * @param DrinkInterface $drink
     *
     * @return DrinkInterface
     */
    public function commandDrink(DrinkInterface $drink): DrinkInterface;

    /**
     * @param DrinkInterface $drink
     *
     * @return bool
     * @throws HaventEnoughMoney
     */
    public function haveEnoughMoney(DrinkInterface $drink): bool;

    /**
     * @return void
     */
    public function initializeConsumable(): void;

    /**
     * @return void
     */
    public function resetConsumable(): void;
}