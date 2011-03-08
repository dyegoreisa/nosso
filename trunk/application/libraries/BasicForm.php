<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/libraries/ItemForm.php';

class BasicForm
{
    private $itens;

    public function addInput($label, $name, $id, $value)
    {
        $this->itens[] = new ItemForm($label, $name, $id, $value, NULL, 'input');
    }
    
    public function addRadio($label, $name, $id)
    {
        $item = new ItemForm($label, $name, $id, '', NULL, 'radio');
        $this->itens[] = $item;
        return $item;
    }

    public function getItens()
    {
        return $this->itens;
    }
}

?>
