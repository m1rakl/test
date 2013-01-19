<?php

abstract class Component
{

    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    abstract public function add(Component $c);

    abstract public function remove(Component $c);

    abstract public function display();
}

class Folder extends Component
{

    protected $components = array();

    public function add(Component $c)
    {
        $this->components[$c->name] = $c;
    }

    public function remove(Component $c)
    {
        unset($this->components[$c->name]);
    }

    public function display()
    {
        echo '<ul>';
        echo '<li><b>' . $this->name . '</b></li>';
        foreach ($this->components as $c)
        {
            $c->display();
        }
        echo '</ul>';
    }

}

class File extends Component
{

    public function add(Component $c)
    {
        echo "Can't add component " . $c->name . " to file " . $this->name;
    }

    public function remove(Component $c)
    {
        echo "Can't remove component " . $c->name . " from file " . $this->name;
    }

    public function display()
    {
        echo '<li>' . $this->name . '</li>';
    }

}

$root = new Folder('root');
$root->add(new File('file1'));
$root->add(new File('file2'));

$subFolder = new Folder('subfolder');
$subFolder->add(new File('subFile1'));
$subFolder->add(new File('subFile2'));

$root->add($subFolder);
$root->add(new File('file3'));

$root->display();
