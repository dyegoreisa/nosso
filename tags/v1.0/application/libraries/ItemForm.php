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
    /**
     * Este campo pode ser usado para colocar qualquer valor para qualquer finalidade
     * 
     * @var mixed
     * @access private
     */
    private $tag;

    private $itens;

    public function __construct($label, $name, $id, $value, $class, $checked, $type, $tag = NULL)
    {
        $this->label   = $label;
        $this->name    = $name;
        $this->id      = $id;
        $this->value   = $value;
        $this->class   = $class;
        $this->checked = (!empty($checked) && $checked == $this->value) ? TRUE : FALSE;
        $this->type    = $type;
        $this->tag     = $tag;
    }

    public function addItem($label, $name, $id, $value, $class, $checked = NULL, $type = NULL, $tag = NULL)
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

    public function getTag()
    {
        return $this->tag;
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
        return $this->checked;
    }
}
?>
