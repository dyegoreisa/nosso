<?php
echo validation_errors();
echo '<div class="form">';
echo form_open($action, array('class' => 'formulario'));
if(isset($id)) {
    echo form_hidden('id', $id);
}
foreach ($this->basicform->getItens() as $item) {
    switch($item->getType())
    {
        case 'label':
            echo "<div class=\"{$item->getClass()}\">{$item->getLabel()}</div>";
            break;

        case 'input':
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

        case 'radio_image':
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
            break;

        case 'dropdown':
            $valor = set_value($item->getName());
            $valor = empty($valor) ? $item->getValue() : $valor;
            echo form_label($item->getLabel(), $item->getId());
            echo '<br/>';
            echo form_dropdown($item->getName(), $item->getOptionsForDropdown(), $valor);
            break;

        case 'checkbox':
            $checked = set_checkbox($item->getName(), '1');
            $checked = empty($checked) ? $item->isChecked() : TRUE;
            echo form_label($item->getLabel(), $item->getId());
            $dados = array(
                'name'  => $item->getName(),
                'id'    => $item->getId(),
                'value' => $item->getValue()
            );
            echo form_checkbox($dados);
            break;

        case 'hidden':
            $valor = set_value($item->getName());
            $valor = empty($valor) ? $item->getValue() : $valor;
            echo form_hidden($item->getName(), $valor);
            break;
    }
    echo '<br/>';
}
if (isset($submit)) {
    $class = (isset($class)) ? $class : '';
    echo '<br/>';
    $data = array(
        'value' => $submit,
        'class' => $class
    );
    echo form_submit($data);
}
echo form_close();
echo '</div>';
?>
