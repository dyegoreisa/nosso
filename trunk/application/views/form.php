<?php
echo validation_errors();
echo '<div class="form">';
echo form_open($action);
if(isset($id)) {
    echo form_hidden('id', $id);
}
foreach ($this->basicform->getItens() as $item) {
    switch($item->getType())
    {
        case 'input':
            $valor = set_value($item->getName());
            $valor = empty($valor) ? $item->getValue() : $valor;
            echo form_label($item->getLabel(), $item->getId());
            echo form_input(array(
                'name'    => $item->getName(),
                'id'      => $item->getId(),
                'value'   => $valor,
                'class'   => $item->getClass()
            ));
            break;

        case 'radio':
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
            break;

        case 'dropdown':
            $valor = set_value($item->getName());
            $valor = empty($valor) ? $item->getValue() : $valor;
            echo form_label($item->getLabel(), $item->getId());
            echo form_dropdown($item->getName(), $item->getOptionsForDropdown(), $valor);
            break;

        case 'checkbox':
            $checked = set_checkbox($item->getName(), '1');
            $checked = empty($checked) ? $item->isChecked() : TRUE;
            echo form_label($item->getLabel(), $item->getId());
            echo form_checkbox($item->getName(), $item->getValue());
            break;
    }
    echo '<br/>';
}
echo form_submit('', $submit);
echo form_close();
echo '</div>';
?>
