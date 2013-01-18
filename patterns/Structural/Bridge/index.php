<?php

interface IDrawer
{

    public function draw($x, $y, $radius);
}

class LargeCyrcleDrawer implements IDrawer
{

    const RADIUS_MULTIPLIER = 100;

    public function draw($x, $y, $radius)
    {
        echo 'Large cyrcle with center (' . $x . ', ' . $y . ') and radius ' . $radius * self::RADIUS_MULTIPLIER;
    }

}

class SmallCyrcleDrawer implements IDrawer
{

    const RADIUS_MULTIPLIER = 0.5;

    public function draw($x, $y, $radius)
    {
        echo 'Large cyrcle with center (' . $x . ', ' . $y . ') and radius ' . $radius * self::RADIUS_MULTIPLIER;
    }

}

abstract class Shape
{

    protected $drawer;

    public function __construct(IDrawer $drawer)
    {
        $this->drawer = $drawer;
    }

    abstract public function render();

    abstract public function changeScale($multiplier);
}

class Cyrcle extends Shape
{

    private $x;
    private $y;
    private $radius;

    public function __construct($x, $y, $radius, IDrawer $drawer)
    {
        parent::__construct($drawer);

        $this->x = $x;
        $this->y = $y;
        $this->radius = $radius;
    }

    public function render()
    {
        $this->drawer->draw($this->x, $this->y, $this->radius);
    }

    public function changeScale($multiplier)
    {
        $this->radius *= $multiplier;
    }

}

$largeCyrcle = new Cyrcle(4, 5, 20, new LargeCyrcleDrawer());
$largeCyrcle->render();
$largeCyrcle->changeScale(0.5);
$largeCyrcle->render();