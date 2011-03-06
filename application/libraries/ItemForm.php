<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ItemForm
{
	private $label;
	private $name;
	private $id;
	private $value;
	private $type;

	private $itens;

	public function __construct($label, $name, $id, $value, $type)
	{
		$this->label = $label;
		$this->name  = $name;
		$this->id    = $id;
		$this->value = $value;
		$this->type  = $type;
	}

	public function addItem($label, $name, $id, $value, $type = null)
	{
		$this->itens[] = new ItemForm($label, $name, $id, $value, $type);
	}
	public function getLabel() {
		return $this->label;
	}

	public function getName(){
		return $this->name;
	}

	public function getId() {
		return $this->id;
	}

	public function getValue() {
		return $this->value;
	}

	public function getType() {
		return $this->type;
	}

	public function getArrayAttr()
	{
		return array(
			$this->name,
			$this->id,
			$this->value
		);
	}

	public function getItens()
	{
		return $this->itens;
	}
}
?>
