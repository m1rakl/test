<?php

class CPU
{
    public function execute()
    {
        echo 'CPU executing';
    }
}

class Memory
{
    public function load($data)
    {
        echo 'loading to memory ' . $data;
    }
}

class HardDrive
{
    public function read()
    {
        return 'data from HardDrive ';
    }
}

class Computer
{
    private $cpu = null;
    private $memory = null;
    private $hardDrive = null;

    public function __construct()
    {
        $this->cpu = new CPU();
        $this->memory = new Memory();
        $this->hardDrive = new HardDrive();
    }

    public function start()
    {
        $this->memory->load($this->hardDrive->read());
        $this->cpu->execute();
    }
}

$computer = new Computer();
$computer->start();
