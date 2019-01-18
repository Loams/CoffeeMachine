<?php

namespace CoffeeMachine\Interfaces;

use CoffeeMachine\Exception\CantAddConsumableException;
use CoffeeMachine\Exception\CantRemoveConsumableException;

interface ConsumableInterface
{
    /**
     * @return int
     */
    public function getMax(): int;

    /**
     * @return int
     */
    public function getMin(): int;

    /**
     * @return bool
     */
    public function canAddConsumable(): bool;

    /**
     * @return bool
     */
    public function canRemoveConsumable(): bool;

    /**
     * return void
     */
    public function addConsumable(): void;

    /**
     * @return void
     */
    public function removeConsumable(): void;

    /**
     * @return int
     */
    public function getTotal(): int;

    /**
     * @throws CantAddConsumableException
     */
    public function unableToAddMoreConsumable();

    /**
     * @throws CantRemoveConsumableException
     */
    public function unableToRemoveMoreConsumable();
}