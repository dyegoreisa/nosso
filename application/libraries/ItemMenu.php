<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ItemMenu
{
    private $label;
    private $link;
	private $excluir;

    public function __construct($label, $link, $excluir = NULL)
    {
        $this->label   = $label;
        $this->link    = $link;
		$this->excluir = $excluir;
    }

    public function getLabel() 
    {
        return $this->label;
    }

    public function getLink() 
    {
        return $this->link;
    }

	public function isExcluir()
	{
		return (isset($this->excluir) && $this->excluir == TRUE) ? TRUE : FALSE;
	}
}

?>
