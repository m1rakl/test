<?php

interface Observer
{

    public function notify($obj);
}

class ExchangeRate
{

    private static $instance = null;
    private $exchange_rate;
    private $observers = array();

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

    public static function getInstance()
    {
        if (is_null(self::$instance))
        {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function setExchangeRate($val)
    {
        $this->exchange_rate = $val;

        $this->notifyObservers();
    }

    public function getExchangeRate()
    {
        return $this->exchange_rate;
    }

    protected function notifyObservers()
    {
        foreach ($this->observers as $observer)
        {
            $observer->notify($this);
        }
    }

    public function registerObserver(Observer $observer)
    {
        $this->observers[] = $observer;
    }

}

class ConcreteObserver1 implements Observer
{

    public function __construct()
    {
        ExchangeRate::getInstance()->registerObserver($this);
    }

    public function notify($obj)
    {
        if ($obj instanceof ExchangeRate)
        {
            echo 'Observer1 received update.';
        }
    }

}

class ConcreteObserver2 implements Observer
{

    public function __construct()
    {
        ExchangeRate::getInstance()->registerObserver($this);
    }

    public function notify($obj)
    {
        if ($obj instanceof ExchangeRate)
        {
            echo 'Observer2 received update.';
        }
    }

}

$observer1 = new ConcreteObserver1();
$observer2 = new ConcreteObserver2();

ExchangeRate::getInstance()->setExchangeRate(1.5);