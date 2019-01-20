<?php

namespace Tests\Feature;

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

    public function testCreateACoffeeWithTwoSugarAndOneMilk()
    {
        $this->addCoin(2);
        $this->addSugar(2);
        $this->coffeeMachine->addMilk();

        $coffee = $this->coffeeMachine->commandCoffee();

        $this->assertInstanceOf(Coffee::class, $coffee);
        $this->assertEquals(2, $coffee->getSugar());
        $this->assertEquals(1, $coffee->getMilk());
    }

    public function testCreateATeaWithOneSugarAndTwoMilk()
    {
        $this->addCoin(3);
        $this->coffeeMachine->addSugar();
        $this->addMilk(2);

        $tea = $this->coffeeMachine->commandTea();

        $this->assertInstanceOf(Tea::class, $tea);
        $this->assertEquals(1, $tea->getSugar());
        $this->assertEquals(2, $tea->getMilk());
    }

    public function testCreateAChocolateWithoutMilkAndSugar()
    {
        $this->addCoin(5);

        $chocolate = $this->coffeeMachine->commandChocolate();

        $this->assertInstanceOf(Chocolate::class, $chocolate);
        $this->assertEquals(0, $chocolate->getMilk());
        $this->assertEquals(0, $chocolate->getSugar());
    }

    public function testSuccessIfCreateACoffeeAndChocolateAfterward()
    {
        $this->addCoin(3);
        $coffee = $this->coffeeMachine->commandCoffee();

        $this->assertInstanceOf(Coffee::class, $coffee);
        $this->assertEquals(0, $coffee->getMilk());
        $this->assertEquals(0, $coffee->getSugar());

        $this->addCoin(4);

        $this->assertEquals(5, $this->coffeeMachine->getAmount());

        $chocolate = $this->coffeeMachine->commandChocolate();

        $this->assertInstanceOf(Chocolate::class, $chocolate);
        $this->assertEquals(0, $chocolate->getMilk());
        $this->assertEquals(0, $chocolate->getSugar());
    }

    public function testThrowExceptionIfCreateACoffeeAndChocolateAfterwardWithoutEnoughtAmount()
    {
        $this->addCoin(3);
        $coffee = $this->coffeeMachine->commandCoffee();

        $this->assertInstanceOf(Coffee::class, $coffee);
        $this->assertEquals(0, $coffee->getMilk());
        $this->assertEquals(0, $coffee->getSugar());

        $this->addCoin(3);

        $this->assertEquals(4, $this->coffeeMachine->getAmount());
        $this->expectException(HaventEnoughMoney::class);
        $this->expectExceptionMessage('You don\'t have enought amount');
        $this->coffeeMachine->commandChocolate();
    }

    public function testSuccessIfCreateACoffeeAndChocolateAfterwardWithDifferentConsumable()
    {
        $this->addCoin(3);

        $this->addMilk(1);
        $this->addSugar(3);
        $coffee = $this->coffeeMachine->commandCoffee();

        $this->assertInstanceOf(Coffee::class, $coffee);
        $this->assertEquals(1, $coffee->getMilk());
        $this->assertEquals(3, $coffee->getSugar());

        $this->addCoin(4);

        $this->assertEquals(5, $this->coffeeMachine->getAmount());

        $this->addMilk(2);
        $this->addSugar(2);
        $chocolate = $this->coffeeMachine->commandChocolate();

        $this->assertInstanceOf(Chocolate::class, $chocolate);
        $this->assertEquals(2, $chocolate->getMilk());
        $this->assertEquals(2, $chocolate->getSugar());
    }

    private function addCoin(int $nbCoin)
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