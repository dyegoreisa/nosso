<?php
echo validation_errors();
echo form_open($action);
if(isset($id)) {
	echo form_hidden('id', $id);
}
foreach ($this->basicform->getItens() as $item) {
    switch($item->getType())
	{
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
			}
			echo form_fieldset_close();
			break;

		case 'input':
			$valor = set_value($item->getName());
			$valor = empty($valor) ? $item->getValue() : $valor;
			echo form_label($item->getLabel(), $item->getId());
			echo form_input(array(
				'name'    => $item->getName(),
				'id'      => $item->getId(),
				'value'   => $valor,
			));
    }
	echo '<br/>';
}
echo form_submit('', $submit);
echo form_close();
?>
