<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/libraries/ItemForm.php';

class RenderBasicForm
{
    private $action;
    private $multpart;
    private $id;
    private $submit;
    private $class;

    public function __construct ($action, $submit, $class = FALSE, $id = FALSE, $multpart = FALSE)
    {
        $this->action   = $action;
        $this->multpart = $multpart;
        $this->id       = $id;
        $this->submit   = $submit;
        $this->class    = $class;    
    }
    
    public function printHeader()
    {
        echo validation_errors();
        echo '<div class="form">';
        if ($this->multpart) {
            echo form_open_multipart($this->action, array('class' => 'formulario'));
        } else {
            echo form_open($this->action, array('class' => 'formulario'));
        }
        if($this->id) {
            echo form_hidden('id', $this->id);
        }
    }

    public function printFooter()
    {
        if ($this->submit) {
            $class = ($this->class) ? $this->class : '';
            echo '<br/>';
            echo form_submit(array(
                'value' => $this->submit,
                'class' => $class
            ));
        }
        echo form_close();
        echo '</div>';
    }

    public function printLabel(ItemForm $item)
    {
        echo "<div class=\"{$item->getClass()}\">{$item->getLabel()}</div>";
        echo '<br/>';
    }

    public function printInput(ItemForm $item)
    {
        $valor = set_value($item->getName());
        $valor = empty($valor) ? $item->getValue() : $valor;
        echo form_label($item->getLabel(), $item->getId());
        echo '<br/>';
        echo form_input(array(
            'name'    => $item->getName(),
            'id'      => $item->getId(),
            'value'   => $valor,
            'class'   => $item->getClass()
        ));
        echo '<br/>';
    }

    public function printRadio(ItemForm $item)
    {
        echo form_fieldset($item->getLabel());
        foreach ($item->getItens() as $subItem) {
            $checked = set_radio($subItem->getName(), $subItem->getValue());
            $checked = empty($checked) ? $subItem->isChecked() : TRUE;
            echo form_radio(array(
                'name'    => $subItem->getName(),
                'id'      => $subItem->getId(),
                'value'   => $subItem->getValue(),
                'checked' => $checked
            ));
            echo form_label($subItem->getLabel(), $subItem->getId());
            echo '<br/>';
        }
        echo form_fieldset_close();
        echo '<br/>';
    }

    public function printRadioImage(ItemForm $item)
    {
        echo form_fieldset($item->getLabel());
        foreach ($item->getItens() as $subItem) {
            $checked = set_radio($subItem->getName(), $subItem->getValue());
            $checked = empty($checked) ? $subItem->isChecked() : TRUE;
            echo form_radio(array(
                'name'    => $subItem->getName(),
                'id'      => $subItem->getId(),
                'value'   => $subItem->getValue(),
                'checked' => $checked
            ));
            $imageProperties = array(
                'src'    => "theme/images/{$subItem->getLabel()}.png",
                'alt'    => $subItem->getLabel(),
                'width'  => '50',
                'height' => '135'
            );

            echo img($imageProperties);
        }
        echo form_fieldset_close();
        echo '<br/>';
    }

    public function printDropdown(ItemForm $item)
    {
        $valor = set_value($item->getName());
        $valor = empty($valor) ? $item->getValue() : $valor;
        echo form_label($item->getLabel(), $item->getId());
        echo '<br/>';
        echo form_dropdown($item->getName(), $item->getOptionsForDropdown(), $valor);
        echo '<br/>';
    }

    public function printCheckbox(ItemForm $item)
    {
        $checked = set_checkbox($item->getName(), '1');
        $checked = empty($checked) ? $item->isChecked() : TRUE;
        echo form_label($item->getLabel(), $item->getId());
        $dados = array(
            'name'  => $item->getName(),
            'id'    => $item->getId(),
            'value' => $item->getValue()
        );
        echo form_checkbox($dados);
        echo '<br/>';
    }

    public function printHidden(ItemForm $item)
    {
        $valor = set_value($item->getName());
        $valor = empty($valor) ? $item->getValue() : $valor;
        echo form_hidden($item->getName(), $valor);
        echo '<br/>';
    }

    public function printImageFile(ItemForm $item)
    {
        $valor = set_value($item->getName());
        $valor = empty($valor) ? $item->getValue() : $valor;
        echo form_label($item->getLabel(), $item->getId());
        echo '<br/>';
        if (!empty($valor)) {
            echo "<img src=\"{$valor}\" height=\"{$item->getTag()}\">";
            echo '<br/>';
        }
        echo form_upload(array(
            'name'    => $item->getName(),
            'id'      => $item->getId(),
            'class'   => $item->getClass()
        ));
        echo '<br/>';
    }
}
