<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ItemMenu
{
	private $label;
	private $link;

	public function __construct($label, $link)
	{
		$this->label = $label;
		$this->link  = $link;
	}

	public function getLabel() {
		return $this->label;
	}

	public function getLink() {
		return $this->link;
	}
}

?>