<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/libraries/ItemMenu.php';

class Acoes
{
    private $itens;

    public function addItem($label, $link, $excluir = NULL)
    {
        $this->itens[] = new ItemMenu($label, $link, $excluir);
    }

    public function render($id, $descricao = '')
    {
        foreach ($this->itens as $item) {
			$attr = '';
			if ($item->isExcluir()) {
				$attr = "class=\"excluir\" alt=\"{$descricao}\"";
			}
			echo "<a {$attr} href=\"{$item->getLink()}/{$id}\">{$item->getLabel()}</a>";
        }
    }
}
