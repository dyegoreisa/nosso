<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/libraries/ItemTitulo.php';

class Titulos
{
    private $itens;

    public function addItem($label, $link = NULL, $field = NULL, $order = NULL, $icon = NULL)
    {
        $this->itens[] = New ItemTitulo($label, $link, $field, $order, $icon);
    }

    public function change($field, $order)
    {
        foreach ($this->itens as $item) {
            if ($field == $item->getField()) {
                $item->changeOrder($order);
                break;
            }
        }
    }

    public function render()
    {
        foreach ($this->itens as $item) {
            if ($item->getField() !== NULL) {
                echo "<th nowrap><a class=\"order\" href=\"{$item->getLink()}/{$item->getField()}/{$item->getOrder()}\">{$item->getLabel()}&nbsp;".
                     "<img src=\"/theme/images/{$item->getIcon()}.png\" border=\"0\"></a></th>";
            } else {
                echo "<th>{$item->getLabel()}</th>";
            }
        }
    }
}
