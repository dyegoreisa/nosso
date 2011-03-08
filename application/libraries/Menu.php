<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu
{
    const MENU_FILE = 'application/config/menu.xml';

    public function render()
    {
        $menu = simplexml_load_file(self::MENU_FILE);

        echo '<ul class="sf-menu">';
        foreach ($menu as $item) {
            echo "<li><a href=\"{$item->link}\">{$item->label}</a>";
            if (isset($item->submenu) === true) {
                echo '<ul>';
                foreach ($item->submenu->item as $subitem) {
                    echo "<li><a href=\"{$subitem->link}\">{$subitem->label}</a></li>";
                }
                echo '</ul>';
            }
            echo '</li>';
        }
        echo '</ul>';
    }
}

?>
