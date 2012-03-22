<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ItemMenu
{
    private $label;
    private $link;
	private $class;

    public function __construct($label, $link, $class = NULL)
    {
        $this->label = $label;
        $this->link  = $link;
		$this->class = $class;
    }

    public function getLabel() 
    {
        return $this->label;
    }

    public function getLink() 
    {
        return $this->link;
    }

	public function getClass()
	{
		return $this->class;
	}
}

?>
