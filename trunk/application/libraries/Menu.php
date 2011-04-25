<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu
{
    //const MENU_FILE = 'application/config/menu.xml';
    //const MENU_FILE = 'application/config/menu_family.xml';
    const MENU_FILE = 'application/config/menu_tabs.xml';

    public function render($tipo, $class = '')
    {
        switch($tipo)
        {
            case 'ul':
                $this->renderUl($class);
                break;

            case 'tabs':
                $this->renderTabs($class);
                break;
        }
    }

    private function renderUl($class)
    {
        $menu = simplexml_load_file(self::MENU_FILE);

        echo "<ul class=\"{$class}\">";
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

    private function renderTabs($class)
    {
        $menu = simplexml_load_file(self::MENU_FILE);
        $cssId = $class;
        $contents1 = array();
        $contents2 = array();

        echo "<div class=\"{$class}\">";
        $contents1[] = "<ul>";
        $count = 1;
        foreach ($menu as $item) {
            $contents1[] = "<li><a href=\"#{$cssId}{$count}\">{$item->label}</a>";
            $contents2[] = "<div id=\"{$cssId}{$count}\">";

            if ($item->link != '#') {
                $contents2[] = "<a href=\"{$item->link}\">{$item->label}</a>";
            }

            if (isset($item->submenu) === true) {
                $contents2[] = '<ul>';
                foreach ($item->submenu->item as $subitem) {
                    $contents2[] = "<li><a href=\"{$subitem->link}\">{$subitem->label}</a></li>";
                }
                $contents2[] = '</ul>';
            }

            $contents2[] = '</div>';
            $contents1[] = '</li>';
            $count++;
        }
        $contents1[] = '</ul>';
        echo implode('', $contents1);
        echo implode('', $contents2);
        echo '</div>';
        
    }
}

?>
