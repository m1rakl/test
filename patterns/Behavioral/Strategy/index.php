<?php

interface Strategy
{

    function createName($filename);
}

class ZipFileStrategy implements Strategy
{

    function createName($filename)
    {
        return "http://downloads.foo.bar/{$filename}.zip";
    }

}

class TarGzFileStrategy implements Strategy
{

    function createName($filename)
    {
        return "http://downloads.foo.bar/{$filename}.tar.gz";
    }

}

class Context
{

    private $strategy;

    function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    function execute()
    {
        $url[] = $this->strategy->createName("file1");
        $url[] = $this->strategy->createName("fiel2");

        return $url;
    }

}

if (substr(PHP_OS, 0, 3))
{
    $context = new Context(new ZipFileStrategy());
}
else
{
    $context = new Context(new TarGzFileStrategy());
}

$result = $context->execute();

echo '<pre>';
print_r($result);