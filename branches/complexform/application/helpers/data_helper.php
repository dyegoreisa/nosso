<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function dataInicioFimMesCorrente()
{
    $ano = date("Y");
    $mes = date("m");
    $dia = date("d", strtotime(date("Y/m/d", mktime(0, 0, 0, $mes, 1, $ano)) . "day"));
    return array(
        'dataInicio' => "{$ano}-{$mes}-01",
        'dataFim'    => "{$ano}-{$mes}-{$dia}"
    );
}
