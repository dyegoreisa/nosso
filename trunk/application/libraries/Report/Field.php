<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Field
{
    private $name;
    private $label;
    private $aliasDB;
    private $aliasOrder;

    public function __construct($name, $label, $aliasDB, $aliasOrder)
    {
        $this->name       = $name;
        $this->label      = $label;
        $this->aliasDB    = $aliasDB;
        $this->aliasOrder = $aliasOrder;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getAliasDB()
    {
        return $this->aliasDB;
    }
    
    public function getAliasOrder()
    {
        return $this->aliasOrder;
    }
}
?>
