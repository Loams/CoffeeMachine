<?php

namespace Tests\Unit;

use CoffeeMachine\Exceptions\CantAddConsumableException;
use CoffeeMachine\Exceptions\CantRemoveConsumableException;
use CoffeeMachine\Exceptions\HaventEnoughMoney;
use CoffeeMachine\Models\Chocolate;
use CoffeeMachine\Models\Coffee;
use CoffeeMachine\Models\CoffeeMachine;
use CoffeeMachine\Models\Tea;
use PHPUnit\Framework\TestCase;

class CoffeeMachineTest extends TestCase
{
    /**
     * @var CoffeeMachine
     */
    private $coffeeMachine;

    public function setUp()
    {
        $this->coffeeMachine = new CoffeeMachine();
    }

    public function testSuccessWhenYouCommandATea()
    {
        $this->addAmount(3);
        $this->assertInstanceOf(Tea::class ,$this->coffeeMachine->commandTea());
    }

    public function testThrowExceptionIfYouHaveNotEnoughtAmountForATea()
    {
        $this->addAmount(1);
        $this->expectException(HaventEnoughMoney::class);
        $this->expectExceptionMessage('You don\'t have enought amount');
        $this->coffeeMachine->commandTea();
    }

    public function testSuccessWhenYouCommandACoffee()
    {
        $this->addAmount(2);
        $this->assertInstanceOf(Coffee::class ,$this->coffeeMachine->commandCoffee());
    }

    public function testSuccessWhenYouCommandAChocolate()
    {
        $this->addAmount(5);
        $this->assertInstanceOf(Chocolate::class ,$this->coffeeMachine->commandChocolate());
    }


    public function testSuccessWhenYouAdd1sugar()
    {
        $this->coffeeMachine->addSugar();
        $this->assertEquals(1, $this->coffeeMachine->sugar->getTotal());
    }

    public function testSuccessWhenYouAdd2sugar()
    {
        $this->addSugar(2);
        $this->assertEquals(2, $this->coffeeMachine->sugar->getTotal());
    }

    public function testThrowExceptionIfTryToAddMoreMaximumSugar()
    {
        $this->expectException(CantAddConsumableException::class);
        $this->expectExceptionMessage('You canno\'t add more sugar');
        $this->addSugar(5);
    }

    public function testThrowExceptionIfTryToRemoveSugar()
    {
        $this->expectException(CantRemoveConsumableException::class);
        $this->expectExceptionMessage('You canno\'t remove more sugar');
        $this->coffeeMachine->removeSugar();
    }

    public function testSuccessOnRemoveSugar()
    {
        $this->addSugar(4);
        $this->coffeeMachine->removeSugar();

        $this->assertEquals(3, $this->coffeeMachine->sugar->getTotal());
    }
    public function testSuccessWhenYouTryToAddOneMilk()
    {
        $this->coffeeMachine->addMilk();
        $this->assertEquals(1, $this->coffeeMachine->milk->getTotal());
    }

    public function testSuccessOnAddTwoMilk()
    {
        $this->addMilk(2);
        $this->assertEquals(2, $this->coffeeMachine->milk->getTotal());
    }

    public function testThrowExceptionIfTryToAddMoreToMaximumMilk()
    {
        $this->expectException(CantAddConsumableException::class);
        $this->expectExceptionMessage('You canno\'t add more milk');
        $this->addMilk(5);
    }

    public function testSuccessOnRemoveOneMilk()
    {
        $this->addMilk(4);
        $this->coffeeMachine->removeMilk();

        $this->assertEquals(3, $this->coffeeMachine->milk->getTotal());
    }

    public function testThrowExceptionIfTryToRemoveMilk()
    {
        $this->expectException(CantRemoveConsumableException::class);
        $this->expectExceptionMessage('You canno\'t remove more milk');
        $this->coffeeMachine->removeMilk();
    }

    public function testSuccessDisplayAmount()
    {
        $this->addAmount(4);
        $this->assertEquals(4, $this->coffeeMachine->displayAmount());
    }

    public function testSuccessRecoverAmount()
    {
        $this->addAmount(6);

        $this->assertEquals(6, $this->coffeeMachine->recoverAmount());
        $this->assertEquals(0, $this->coffeeMachine->displayAmount());
    }

    private function addAmount(int $nbCoin)
    {
        for($i = 0; $i < $nbCoin; $i++) {
            $this->coffeeMachine->addMoney();
        }
    }

    private function addMilk(int $nbMilk)
    {
        for($i = 0; $i < $nbMilk; $i++) {
            $this->coffeeMachine->addMilk();
        }
    }

    private function addSugar(int $nbSugar)
    {
        for($i = 0; $i < $nbSugar; $i++) {
            $this->coffeeMachine->addSugar();
        }
    }
}