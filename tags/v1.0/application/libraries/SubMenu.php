<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/libraries/ItemMenu.php';

class SubMenu
{
    private $itens;

    public function addItem($label, $link, $class = NULL)
    {
        $this->itens[] = new ItemMenu($label, $link, $class);
    }

    public function render()
    {
        if (isset($this->itens)) {
            echo '<ul>';
            foreach ($this->itens as $item) {
                $class = $item->getClass();
                $class = (isset($class)) ? "class=\"{$item->getClass()}\"" : '';
                echo "<li><a {$class} href=\"{$item->getLink()}\">{$item->getLabel()}</a></li>";
            }
            echo '</ul>';
        }
    }
}
