<?php

/**
 * singleton pattern is a design pattern that restricts the instantiation of a class to one object
 */
class Singleton
{

    public static $instance;

    private function __construct()
    {

    }

    private function __clone()
    {

    }

    private function __wakeup()
    {

    }

    public static function getInstance()
    {
        if (is_null(self::$instance))
        {
            self::$instance = new Singleton();
        }

        return self::$instance;
    }

    public function doAction()
    {
        echo 'hello!';
    }

}

Singleton::getInstance()->doAction();
