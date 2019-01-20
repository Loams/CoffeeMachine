<?php

namespace CoffeeMachine\Models;

use CoffeeMachine\Exceptions\CantAddConsumableException;
use CoffeeMachine\Exceptions\CantRemoveConsumableException;
use CoffeeMachine\Interfaces\CoffeeMachineInterface;
use CoffeeMachine\Interfaces\DrinkInterface;

class CoffeeMachine extends AbstractDrinkMachine implements CoffeeMachineInterface
{

    /**
     * @var Sugar
     */
    public $sugar;

    /**
     * @var Milk
     */
    public $milk;

    /**
     * Command a Coffee
     *
     * @return DrinkInterface|Coffee
     * @throws \Exception
     */
    public function commandCoffee(): Coffee
    {
        $coffee = $this->commandDrink(new Coffee($this->sugar, $this->milk));

        return $coffee;
    }

    /**
     * Command a Tea
     *
     * @return DrinkInterface|Tea
     * @throws \Exception
     */
    public function commandTea(): Tea
    {
        $tea = $this->commandDrink(new Tea($this->sugar, $this->milk));

        return $tea;
    }

    /**
     * Command a Chocolate
     *
     * @return DrinkInterface|Chocolate
     * @throws \Exception
     */
    public function commandChocolate(): Chocolate
    {
        $chocolate = $this->commandDrink(new Chocolate($this->sugar, $this->milk));

        return $chocolate;
    }


    /**
     * Add Sugar
     *
     * @throws CantAddConsumableException
     */
    public function addSugar(): void
    {
        $this->sugar = $this->addConsumable($this->sugar);
    }

    /**
     * Remove Sugar
     *
     * @throws CantRemoveConsumableException
     */
    public function removeSugar(): void
    {
        $this->sugar = $this->removeConsumable($this->sugar);
    }

    /**
     * Add Milk
     *
     * @throws CantAddConsumableException
     */
    public function addMilk(): void
    {
        $this->milk = $this->addConsumable($this->milk);
    }

    /**
     * Remove Milk
     *
     * @throws CantRemoveConsumableException
     */
    public function removeMilk(): void
    {
        $this->milk = $this->removeConsumable($this->milk);
    }

    /**
     * Add Coin into coffee machine
     */
    public function addMoney(): void
    {
        $this->setAmount($this->getAmount() + 1);
    }

    /**
     * Display how many money you have
     *
     * @return int
     */
    public function displayAmount(): int
    {
        return $this->getAmount();
    }

    /**
     * Recover your money
     *
     * return int
     */
    public function recoverAmount(): int
    {
        $amount = $this->getAmount();
        $this->setAmount(0);

        return $amount;
    }

    /**
     * Reset Consumable
     */
    public function resetConsumable(): void
    {
        $this->initializeConsumable();
    }

    /**
     * Initialize Consumable
     */
    public function initializeConsumable(): void
    {
        $this->milk = new Milk();
        $this->sugar = new Sugar();
    }
}