<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'api/ofc/php-ofc-library/open-flash-chart.php';

class Grafico
{
    private $chart;
    private $scale;
    private $arrayElements;

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

    public function addElement($name, $elements, $color)
    {
        $this->elements[] = $elements;
        $objArea = new area();
        $objArea->set_colour($color);
        $objArea->set_values($elements);
        $objArea->set_key($name, 12);
        $this->chart->add_element($objArea);
    }

    public function setLabels($labels, $color, $title)
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
        $max = $min = 0;
        foreach ($this->elements as $elements)
    }

    public function render()
    {
        $objY = new y_axis();
        $objY->set_range( min($medidas['peso']) - $this->scale, max($medidas['peso']) + $this->scale, $this->scale);
        $chart->add_y_axis( $y );

        echo $chart->toPrettyString();
    }
}
