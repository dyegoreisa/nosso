<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/libraries/ItemForm.php';

class BasicForm
{
	private $itens;

	public function addInput($label, $name, $id, $value)
	{
		$this->itens[] = new ItemForm($label, $name, $id, $value, 'input');
	}
	
	public function addRadio($label, $name, $id, $value)
	{
		$item = new ItemForm($label, $name, $id, $value, 'radio');
		$this->itens[] = $item;
		return $item;
	}

	public function getItens()
	{
		return $this->itens;
	}
}

?>
