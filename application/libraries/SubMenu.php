<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/libraries/ItemMenu.php';

class SubMenu
{
    private $itens;

    public function addItem($label, $link)
    {
        $this->itens[] = new ItemMenu($label, $link);
    }

    public function render()
    {
        if (isset($this->itens)) {
            echo '<ul>';
            foreach ($this->itens as $item) {
                echo "<li><a href=\"{$item->getLink()}\">{$item->getLabel()}</a></li>";
            }
            echo '</ul>';
        }
    }
}
