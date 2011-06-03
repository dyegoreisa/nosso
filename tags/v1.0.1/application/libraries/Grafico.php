<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'api/ofc/php-ofc-library/open-flash-chart.php';

class Grafico
{
    private $chart;
    private $scale;
    private $arrayElements;
    private $max;
    private $min;

    public function __construct()
    {
        $this->chart = new open_flash_chart();
    }

    public function setScale($scale)
    {
        $this->scale = $scale;
    }

    public function setTitulo($title)
    {
        $objTitle = new title($title);
        $objTitle->set_style( "{font-size: 20px; color: #A2ACBA; text-align: center;}" );
        $this->chart->set_title($objTitle);
    }

    public function addElement($elements, $name, $color)
    {
        $this->elements[] = $elements;
        $objLine = new line();
        $objLine->set_width(2);
        $objLine->set_default_dot_style(new solid_dot());
        $objLine->set_colour($color);
        $objLine->set_values($elements);
        $objLine->set_key($name, 12);
        $this->chart->add_element($objLine);
    }

    public function setLabels($labels, $title, $color)
    {
        $objXLabels = new x_axis_labels();
        $objXLabels->set_steps(1);
        $objXLabels->set_vertical();
        $objXLabels->set_colour($color);
        $objXLabels->set_labels($labels);

        $objX = new x_axis();
        $objX->set_colour('#A2ACBA');
        $objX->set_grid_colour('#D7E4A3');
        $objX->set_labels($objXLabels);
        $this->chart->set_x_axis($objX);

        $objXLegend = new x_legend($title);
        $objXLegend->set_style('{font-size: 20px; color: #778877}');
        $this->chart->set_x_legend($objXLegend);
    }

    private function calculateRange()
    {
        $max = 0;
        $min = 99999;
        foreach ($this->elements as $elements) {
            if ($max < max($elements)) {
                $max = max($elements);
            }
            if ($min > min($elements)) {
                $min = min($elements);
            }
        }

        $this->max = $max;
        $this->min = $min;
    }

    public function render()
    {
        $objY = new y_axis();
        $this->calculateRange();
        $objY->set_range($this->min - $this->scale, $this->max + $this->scale, $this->scale);
        $this->chart->add_y_axis($objY);

        echo $this->chart->toPrettyString();
    }
}
