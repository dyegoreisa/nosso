<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/libraries/ItemMenu.php';

class Acoes
{
	private $itens;

	public function addItem($label, $link)
	{
		$this->itens[] = new ItemMenu($label, $link);
	}

	public function render($id)
	{
		foreach ($this->itens as $item) {
			echo "<a href=\"{$item->getLink()}/{$id}\">{$item->getLabel()}</a>";
		}
	}
}