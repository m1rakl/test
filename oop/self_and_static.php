<?php

class A
{

    public static function getStatic()
    {
        return new static();
    }

    public static function getSelf()
    {
        return new self();
    }

}

class B extends A
{

}

echo get_class(A::getSelf()); //A
echo get_class(B::getSelf()); // A

echo get_class(A::getStatic()); // A
echo get_class(B::getStatic()); //B