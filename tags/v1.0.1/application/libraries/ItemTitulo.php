<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ItemTitulo
{
    private $label;
    private $link;
    private $field;
    private $order;

    public function __construct($label, $link, $field, $order, $icon)
    {
        $this->label = $label;
        $this->link  = $link;
		$this->field = $field;
        $this->order = $order;
        $this->icon  = $icon;
    }

    public function getLabel() 
    {
        return $this->label;
    }

    public function getLink() 
    {
        return $this->link;
    }

    public function getField()
    {
        return $this->field;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function changeOrder($order)
    {
        switch ($order)
        {
            case 'ASC':
                $this->order = 'DESC';
                break;

            case 'DESC':
                $this->order = 'ASC';
                break;
        }
        $this->icon = strtolower($order);
    }
}

?>

