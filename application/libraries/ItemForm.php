<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ItemForm
{
    private $label;
    private $name;
    private $id;
    private $value;
    private $checked;
    private $type;

    private $itens;

    public function __construct($label, $name, $id, $value, $checked, $type)
    {
        $this->label   = $label;
        $this->name    = $name;
        $this->id      = $id;
        $this->value   = $value;
        if (!empty($checked) && $checked == $this->value) {
            $this->checked = TRUE;
        }
        $this->type    = $type;
    }

    public function addItem($label, $name, $id, $value, $checked = null, $type = null)
    {
        $this->itens[] = new ItemForm($label, $name, $id, $value, $checked, $type);
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
            'name'  => $this->name,
            'id'    => $this->id,
            'value' => $this->value
        );
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
