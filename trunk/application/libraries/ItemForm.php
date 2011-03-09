<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ItemForm
{
    private $label;
    private $name;
    private $id;
    private $value;
    private $class;
    private $checked;
    private $type;

    private $itens;

    public function __construct($label, $name, $id, $value, $class, $checked, $type)
    {
        $this->label   = $label;
        $this->name    = $name;
        $this->id      = $id;
        $this->value   = $value;
        $this->class   = $class;
        if (!empty($checked) && $checked == $this->value) {
            $this->checked = TRUE;
        }
        $this->type    = $type;
    }

    public function addItem($label, $name, $id, $value, $class, $checked = null, $type = null)
    {
        $this->itens[] = new ItemForm($label, $name, $id, $value, $class, $checked, $type);
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

    public function getClass() {
        return $this->class;
    }

    public function getType() {
        return $this->type;
    }

    public function getArrayAttr()
    {
        return array(
            'name'  => $this->name,
            'id'    => $this->id,
            'value' => $this->value
        );
    }

     public function getOptionsForDropdown()
     {
        $options = array();
        foreach ($this->itens as $item) {
            $options[$item->getId()] = $item->getLabel();
        }
        return $options;
     }

    public function getItens()
    {
        return $this->itens;
    }

    public function isChecked()
    {
        return isset($this->checked) ? TRUE : FALSE;
    }
}
?>
