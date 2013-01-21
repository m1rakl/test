<?php

class Originator
{
    private $state;

    public function setState($state)
    {
        $this->state = $state;
        echo 'state was set to ' . $state . '<br>';
    }

    public function getState()
    {
        return $this->state;
    }

    public function createMemento()
    {
        return new Memento($this->getState());
    }

    public function setMemento(Memento $memento)
    {
        echo 'restoring state to ' . $memento->getState() . '<br>';
        $this->state = $memento->getState();
    }
}

class Memento
{
    private $state;

    public function __construct($state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }
}

class Caretaker
{
    private $memento;

    public function __construct(Memento $memento)
    {
        $this->memento = $memento;
    }

    public function getMemento()
    {
        return $this->memento;
    }
}

$originator = new Originator();
$originator->setState('on');

$caretaker = new Caretaker($originator->createMemento());

$originator->setState('off');

$originator->setMemento($caretaker->getMemento());

