<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Principal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
        $ano = date("Y");
        $mes = date("m");
        $dia = date("d", strtotime(date("Y/m/d", mktime(0, 0, 0, $mes, 1, $ano)) . "day"));
		$this->load->view('principal', array(
            'dataInicio' => "{$ano}-{$mes}-01",
            'dataFim'    => "{$ano}-{$mes}-{$dia}"
        ));
	}
}
?>
