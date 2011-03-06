<?php
echo form_open($action);
foreach ($this->basicform->getItens() as $item) {
    switch($item->getType())
	{
		case 'dropdown':
			echo form_label($item->getLabel(), $item->getId());
//        echo form_dropdown($campo->getName(), $campo->getOptions(), '', "id=\"{$campo->getId()}\"");
			echo '<br/>';
			break;

		case 'radio':
			echo form_fieldset($item->getLabel());
			foreach ($item->getItens() as $subItem) {
				echo form_radio($subItem->getName(), $subItem->getValue());
				echo form_label($subItem->getLabel(), $subItem->getId());
			}
			echo form_fieldset_close();
			break;

		default:
			echo form_label($item->getLabel(), $item->getId());
			echo call_user_func_array("form_{$item->getType()}", array($item->getArrayAttr()));
    }
	echo '<br/>';
}
echo form_submit('', $submit);
echo form_close();
?>
