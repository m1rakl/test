<?php

abstract class Mediator
{
    abstract public function send($msg, Colleague $colleague);
}

abstract class Colleague
{

    private $mediator;

    public function __construct(Mediator $mediator)
    {
        $this->mediator = $mediator;
    }

    public function send($msg)
    {
        $this->mediator->send($msg, $this);
    }

    abstract public function notify($msg, Colleague $sender);
}

class ConcreteColleague1 extends Colleague
{

    public function notify($msg, Colleague $sender)
    {
        echo 'Colleague1 received "' . $msg . '" from ' . get_class($sender) . '<br>';
    }

}

class ConcreteColleague2 extends Colleague
{

    public function notify($msg, Colleague $sender)
    {
        echo 'Colleague2 received "' . $msg . '" from ' . get_class($sender) . '<br>';
    }

}

class ConcreteMediator extends Mediator
{

    private $colleague1;
    private $colleague2;

    public function setColleague1(Colleague $c)
    {
        $this->colleague1 = $c;
    }

    public function setColleague2(Colleague $c)
    {
        $this->colleague2 = $c;
    }

    public function send($msg, Colleague $colleague)
    {
        if ($colleague instanceof ConcreteColleague1)
        {
            $this->colleague2->notify($msg, $colleague);
        }
        elseif ($colleague instanceof ConcreteColleague2)
        {
            $this->colleague1->notify($msg, $colleague);
        }
    }

}

$mediator = new ConcreteMediator();

$colleague1 = new ConcreteColleague1($mediator);
$colleague2 = new ConcreteColleague2($mediator);

$mediator->setColleague1($colleague1);
$mediator->setColleague2($colleague2);

$colleague1->send('How are you?');
$colleague2->send('I am fine');
