# Coffee Machine

This small project aims to create a coffee machine in php

## How to use it

How to add money
```php
$coffeeMachine->addMoney()
```
How to add or remove sugar
```php
$coffeeMachine->addSugar()
$coffeeMachine->removeSugar()
```

How to add or remove milk
```php
$coffeeMachine->addMilk()
$coffeeMachine->removeMilk()
```

How to display amount or recover amount
```php
$coffeeMachine->displayAmount()
$coffeeMachine->recoverAmount();
```

## Create a new Drink

You have to create a new class that extends ``Drink`` and define into constructor the price like this

You can define into your class the consumable needed into the constructor
```
class Tea extends Drink
{
    const PRICE = 3;

    /**
     * Tea constructor.
     *
     * @param Sugar $sugar
     * @param Milk  $milk
     */
    public function __construct(Sugar $sugar, Milk $milk)
    {
        parent::__construct($sugar, $milk);
        $this->price = self::PRICE;
    }
}
```

## Create a new Consumable

You have to create a new class that extends ``AbstractConsumable`` and define your method ``getMax()`` and ``getMin()`` like this 
```
class Milk extends AbstractConsumable
{
    const MAXMILK = 4;
    const MINMILK = 0;

    public function getMax(): int
    {
        return self::MAXMILK;
    }

    public function getMin(): int
    {
        return self::MINMILK;
    }
}
```