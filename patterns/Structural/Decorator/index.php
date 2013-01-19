<?php

abstract class AbstractComponent
{

    abstract public function doAction();
}

class ConcreteComponent extends AbstractComponent
{

    public function doAction()
    {
        echo 'some action';
    }

}

abstract class AbstractDecorator extends AbstractComponent
{

    protected $component;

    public function __construct(AbstractComponent $component)
    {
        $this->component = $component;
    }

    public function doAction()
    {
        $this->component->doAction();
    }

}

class ConcreteDecorator extends AbstractDecorator
{

    public function doAction()
    {
        echo ':start action: ';
        parent::doAction();
        echo ' :end action:';
    }

}

$decorateComponent = new ConcreteDecorator(new ConcreteComponent());
$decorateComponent->doAction();

