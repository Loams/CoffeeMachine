<?php

namespace CoffeeMachine\Models;

use CoffeeMachine\Exceptions\CantAddConsumableException;
use CoffeeMachine\Exceptions\CantRemoveConsumableException;
use CoffeeMachine\Interfaces\ConsumableInterface;

abstract class AbstractConsumable implements ConsumableInterface
{
    public $total = 0;

    /**
     * Get the maximum quantity of consumable can have
     * @return int
     */
    abstract public function getMax(): int;

    /**
     * Get the minimum quantity of consumable can have
     * @return int
     */
    abstract public function getMin(): int;

    /**
     * Check if you can add more consumable
     * @return bool
     */
    public function canAddConsumable(): bool
    {
        return $this->total < $this->getMax();
    }

    /**
     * Check if you can remove more consumable
     * @return bool
     */
    public function canRemoveConsumable(): bool
    {
        return $this->total > $this->getMin();
    }

    /**
     * Add consumable
     */
    public function addConsumable(): void
    {
        $this->total++;
    }

    /**
     * Remove consumable
     */
    public function removeConsumable(): void
    {
        $this->total--;
    }

    /**
     * Get the total of consumable
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @throws CantAddConsumableException
     */
    public function unableToAddMoreConsumable()
    {
        $attribute = $this->getConsumableName();
        throw new CantAddConsumableException($attribute);
    }

    /**
     * @throws CantRemoveConsumableException
     */
    public function unableToRemoveMoreConsumable()
    {
        $attribute = $this->getConsumableName();
        throw new CantRemoveConsumableException($attribute);
    }

    /**
     * Return the name of consumable
     * @return string
     */
    private function getConsumableName(): string
    {
        $attribute = strtolower(get_called_class());
        $explodeFQCN = explode('\\' ,$attribute);
        return end($explodeFQCN);
    }
}