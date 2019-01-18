<?php

namespace CoffeeMachine\Interfaces;

use CoffeeMachine\Models\Chocolate;
use CoffeeMachine\Models\Coffee;
use CoffeeMachine\Models\Tea;

interface CoffeeMachineInterface extends DrinkMachineInterface
{
    public function commandCoffee(): Coffee;

    public function commandTea(): Tea;

    public function commandChocolate(): Chocolate;

    public function addSugar(): void;

    public function removeSugar(): void;

    public function addMilk(): void;

    public function removeMilk(): void;

    public function addMoney(): void;

    public function displayAmount(): int;

    public function recoverAmount(): int;

    public function resetConsumable(): void;

    public function initializeConsumable(): void;
}