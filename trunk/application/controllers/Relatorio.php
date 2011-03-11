<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relatorio extends CI_Controller
{
    public function  __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->helper('form');
        $this->load->library('BasicForm');

        $this->load->model('TipoOperacaoContabil');
        $tipoOperacoes = $this->TipoOperacaoContabil->getOptionsForDropdown();

        $this->load->model('TipoStatusOperacaoContabil');
        $statusOperacoes = $this->TipoStatusOperacaoContabil->getOptionsForDropdown();

        $this->basicform->addInput('Data Incial: ', 'data_inicio', 'data_inicio', 'data', '');
        $this->basicform->addInput('Data Final: ', 'data_fim', 'data_fim', 'data', '');
        $this->basicform->addDropdown('Tipo: ', 'tipo', 'tipo', '', $tipoOperacoes);
        $this->basicform->addDropdown('Status: ', 'status', 'status', '', $statusOperacoes);

        $this->load->view('principal', array(
            'template' => 'form',
            'titulo'   => 'Relatório de contas',
            'dados'    => array(
                'action' => '/Relatorio/executar',
                'submit' => 'Gerar'
            )
        ));
    }

    public function executar()
    {
        $this->load->library('Report/MakeReport');

        // Filtros
        $this->makereport->addFiltro('data_inicio', $this->input->post('data_inicio'), TRUE);
        $this->makereport->addFiltro('data_fim', $this->input->post('data_fim'), TRUE);
        $this->makereport->addFiltro('tipo', $this->input->post('tipo'));
        $this->makereport->addFiltro('status', $this->input->post('status'));

        // Campos
        $this->makereport->addField('status', 'Status', 'tsoc.nome as status', 'status');
        $this->makereport->addField('tipo', 'Tipo', 'toc.nome as tipo', 'tipo');
        $this->makereport->addField('vencimento', 'Vencimento', "DATE_FORMAT(oc.vencimento, '%d/%m/%Y') as vencimento", 'vencimento');
        $this->makereport->addField('valor', 'Valor', 'FORMAT(oc.valor, 2) as valor', NULL);
        $this->makereport->addField('protocolo', 'Protocolo', 'oc.protocolo', NULL);

        $contas  = $this->makereport->process();
		$filtros = $this->makereport->getDisplayFiltros();

        $this->load->view('principal', array(
            'template' => 'Relatorio/resultado',
            'titulo'   => 'Relatório de contas',
            'dados'    => array(
				'contas'  => $contas,
				'filtros' => $filtros
			)
        ));
    }
}
?>
