<?php

namespace CoffeeMachine\Models;

use CoffeeMachine\Exceptions\CantAddConsumableException;
use CoffeeMachine\Exceptions\CantRemoveConsumableException;
use CoffeeMachine\Exceptions\HaventEnoughMoney;
use CoffeeMachine\Interfaces\ConsumableInterface;
use CoffeeMachine\Interfaces\DrinkInterface;

abstract class AbstractDrinkMachine
{

    /**
     * @var int
     */
    protected $amount = 0;

    /**
     * CoffeeMachine constructor.
     */
    public function __construct()
    {
        $this->initializeConsumable();
    }

    /**
     * @return void
     */
    abstract public function initializeConsumable(): void;

    /**
     * This method check if you have enought money before
     *
     * @param DrinkInterface $drink
     *
     * @return DrinkInterface
     * @throws HaventEnoughMoney
     */
    public function commandDrink(DrinkInterface $drink): DrinkInterface
    {
        if ($this->haveEnoughMoney($drink)) {
            $newAmount = $this->remainingMoney($drink);
            $this->setAmount($newAmount);
            $this->resetConsumable();

            return $drink;
        }
        throw new HaventEnoughMoney('You don\'t have enought amount');
    }

    /**
     * Check if you have enough money to pay the drink
     *
     * @param DrinkInterface $drink
     *
     * @return bool
     */
    public function haveEnoughMoney(DrinkInterface $drink): bool
    {
        return $this->amount >= $drink->getPrice();
    }

    /**
     * Return the diff between the price of a Drink and money into coffee machine
     *
     * @param DrinkInterface $drink
     *
     * @return int
     */
    public function remainingMoney(DrinkInterface $drink): int
    {
        return $this->amount - $drink->getPrice();
    }

    /**
     * @return void
     */
    abstract public function resetConsumable(): void;

    /**
     * Get how many money are into coffee machine
     *
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * Set amount
     *
     * @param int $amount
     */
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * Add Consumable if it possible otherwise throw exception
     *
     * @param ConsumableInterface $consumable
     *
     * @return ConsumableInterface
     * @throws CantAddConsumableException
     */
    public function addConsumable(ConsumableInterface $consumable): ConsumableInterface
    {
        if (!$consumable->canAddConsumable()) {
            $consumable->unableToAddMoreConsumable();
        }
        $consumable->addConsumable();

        return $consumable;
    }

    /**
     * Remove Consumable if it possible otherwise throw exception
     *
     * @param ConsumableInterface $consumable
     *
     * @return ConsumableInterface
     * @throws CantRemoveConsumableException
     */
    public function removeConsumable(ConsumableInterface $consumable): ConsumableInterface
    {
        if (!$consumable->canRemoveConsumable()) {
            $consumable->unableToRemoveMoreConsumable();
        }
        $consumable->removeConsumable();

        return $consumable;
    }
}