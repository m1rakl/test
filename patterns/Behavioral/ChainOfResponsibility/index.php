<?php

abstract class Logger
{

    protected $next = null;
    protected $mask;

    const NOTICE = 7;
    const WARNING = 5;
    const ERROR = 3;

    public function __construct($mask)
    {
        $this->mask = $mask;
    }

    public function setNext(Logger $logger)
    {
        return $this->next = $logger;
    }

    public function message($msg, $mask)
    {
        if ($this->mask >= $mask)
        {
            $this->proceedMessage($msg);
        }

        if (!is_null($this->next))
        {
            $this->next->message($msg, $mask);
        }
    }

    abstract public function proceedMessage($msg);
}

class ScreenLogger extends Logger
{

    public function proceedMessage($msg)
    {

        echo 'ScreenLogger: ' . $msg . ';';
    }

}

class MailLogger extends Logger
{

    public function proceedMessage($msg)
    {

        echo 'MailLogger: ' . $msg . ';';
    }

}

class DbLogger extends Logger
{

    public function proceedMessage($msg)
    {

        echo 'DbLogger: ' . $msg . ';';
    }

}

class ChainOfResponsibilityLogger
{

    public static function run()
    {
        //create loggers
        $logger = new ScreenLogger(Logger::NOTICE);
        $logger1 = new MailLogger(Logger::WARNING);
        $logger2 = new DbLogger(Logger::ERROR);

        //set chain of responsibility
        $logger1->setNext($logger2);
        $logger->setNext($logger1);

        //add some messsages
        $logger->message('some text', Logger::NOTICE); //will be processed with only ScreenLogger
        echo '<br>';
        $logger->message('some text', Logger::WARNING); //will be processed with ScreenLogger and MailLogger
        echo '<br>';
        $logger->message('some text', Logger::ERROR); //will be processed with ScreenLogger, MailLogger and DbLogger
    }

}

ChainOfResponsibilityLogger::run();