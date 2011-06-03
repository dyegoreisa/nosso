<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/libraries/ItemForm.php';
require_once 'application/libraries/RenderBasicForm.php';

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

    public function addRadioImage($image, $name, $id)
    {
        $item = new ItemForm($image, $name, $id, '', '', NULL, 'radioImage');
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

    public function addImagemFile($label, $name, $id, $class, $imagem)
    {
        $this->itens[] = new ItemForm($label, $name, $id, $imagem, $class, NULL, 'imageFile', '200');
    }

    public function getItens()
    {
        return $this->itens;
    }

    public function render($action, $submit, $class, $id, $multpart)
    {
        $render = new RenderBasicForm($action, $submit, $class, $id, $multpart);
        $render->printHeader();
        foreach ($this->getItens() as $item) {
            $method = $item->getType();
            $method = 'print' . ucfirst($method);
            $reflectionMethod = new ReflectionMethod('RenderBasicForm', $method);
            $reflectionMethod->invokeArgs($render, array($item));
        }
        $render->printFooter();
    }
}

?>
