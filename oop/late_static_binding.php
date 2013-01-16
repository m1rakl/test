<?php

class A
{
    public static $var = __CLASS__;

    public static function who()
    {
        echo __CLASS__;
    }

    public static function test()
    {
        echo static::$var;
        static::who(); // Here comes Late Static Bindings
    }

}

class B extends A
{
    public static $var = __CLASS__;

    public static function who()
    {
        echo __CLASS__;
    }

}

B::test(); //BB