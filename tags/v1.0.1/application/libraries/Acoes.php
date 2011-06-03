<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/libraries/ItemMenu.php';

class Acoes
{
    private $itens;

    public function addItem($label, $link, $class = NULL)
    {
        $this->itens[] = new ItemMenu($label, $link, $class);
    }

    private function hasExcluir($class)
    {
        $itens = explode(' ', $class);
        foreach ($itens as $item) {
            if ($item == 'excluir') {
                return TRUE;
            }
        }
        return FALSE;
    }

    public function render($id, $descricao = '', $appendClass = '')
    {
        foreach ($this->itens as $item) {
            $alt   = '';
            $class = $item->getClass();

			if ($this->hasExcluir($class) == TRUE) {
				$alt = " alt=\"{$descricao}\"";
                $class .= $appendClass;
			}
            
            if (isset($class)) {
				$class = "class=\"{$class}\" {$alt}";
            }

			echo "<a {$class} href=\"{$item->getLink()}/{$id}\">{$item->getLabel()}</a>&nbsp;";
        }
    }
}
