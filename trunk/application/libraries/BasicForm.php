<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/libraries/ItemForm.php';

class BasicForm
{
    private $itens;

    public function addLabel($label, $class)
    {
        $this->itens[] = new ItemForm($label, '', '', '', $class, NULL, 'label');
    }

    public function addInput($label, $name, $id, $class, $value)
    {
        $this->itens[] = new ItemForm($label, $name, $id, $value, $class, NULL, 'input');
    }
    
    public function addRadio($label, $name, $id)
    {
        $item = new ItemForm($label, $name, $id, '', '', NULL, 'radio');
        $this->itens[] = $item;
        return $item;
    }

	public function addDropdown($label, $name, $id, $value, array $options)
	{
		$item = new ItemForm($label, $name, $id, $value, '', NULL, 'dropdown');
		foreach ($options as $opId => $opLabel) {
			$item->addItem($opLabel, '', $opId, '', '');
		}
		$this->itens[] = $item;
	}

    public function addCheckbox($label, $name, $id, $value, $checked)
    {
        $this->itens[] = new ItemForm($label, $name, $id, $value, '', $checked, 'checkbox');
    }

    public function addHidden($name, $value)
    {
        $this->itens[] = new ItemForm('', $name, '', $value, '', '', 'hidden');
    }

    public function getItens()
    {
        return $this->itens;
    }
}

?>
