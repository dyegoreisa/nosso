<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relatorio extends CI_Controller
{
    private $ajax;

    public function  __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->helper('form');
        $this->load->library('BasicForm');

        //$this->load->model('CategoriaOperacaoContabil');
        //$categoriaOperacoes = $this->CategoriaOperacaoContabil->getOptionsForDropdown();

        //$this->load->model('TipoStatusOperacaoContabil');
        //$statusOperacoes = $this->TipoStatusOperacaoContabil->getOptionsForDropdown(NULL);

        $this->basicform->addInput('Data Incial: ', 'data_inicio', 'data_inicio', 'data', '');
        $this->basicform->addInput('Data Final: ', 'data_fim', 'data_fim', 'data', '');
        //$this->basicform->addDropdown('Categoria: ', 'categoria', 'categoria', '', $categoriaOperacoes);
        //$this->basicform->addDropdown('Status: ', 'status', 'status', '', $statusOperacoes);

        $this->load->view('principal', array(
            'template' => 'form',
            'titulo'   => 'Relatório de contas',
            'dados'    => array(
                'action' => '/Relatorio/executar',
                'submit' => 'Gerar'
            )
        ));
    }

    public function executarAjax($dataInicio = NULL, $dataFim = NULL)
    {
        $this->ajax = TRUE;
        $this->executar($dataInicio, $dataFim);
    }

    public function executar($dataInicio = NULL, $dataFim = NULL)
    {
        if (isset($this->ajax) && $this->ajax == TRUE) {
            $dados = $this->process($dataInicio, $dataFim);
            $this->load->view('Relatorio/dados', $dados);
        } elseif (isset($dataInicio) && isset($dataFim)) {
            $dados = $this->process($dataInicio, $dataFim);
            $this->load->view('principal', array(
                'template' => 'Relatorio/resultado',
                'titulo'   => 'Relatório de contas',
                'js'       => TRUE,
                'dados'    => $dados
            ));
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('data_inicio', 'Data Incial', 'required');

            if ($this->form_validation->run() === FALSE) {
                $this->index();
            } else {
                $dados = $this->process($dataInicio, $dataFim);
                $this->load->view('principal', array(
                    'template' => 'Relatorio/resultado',
                    'titulo'   => 'Relatório de contas',
                    'js'       => TRUE,
                    'dados'    => $dados
                ));
            }
        }
    }

    private function process($dataInicio, $dataFim)
    {
        $this->load->helper('html');
        $this->load->library('Report/MakeReport');

        // Filtros
        if (!isset($dataInicio) && !isset($dataFim)) {
            $dataInicio = $this->input->post('data_inicio');
            $dataFim    = $this->input->post('data_fim');
        }
        $this->makereport->addFiltro('data_inicio', $dataInicio, TRUE);
        $this->makereport->addFiltro('data_fim', $dataFim, TRUE);
        //$this->makereport->addFiltro('categoria', $this->input->post('categoria'));
        //$this->makereport->addFiltro('status', $this->input->post('status'));

        // Campos
        $this->makereport->addField('tipo', 'Tipo', 'toc.nome as tipo', 'tipo');
        $this->makereport->addField('status', 'Status', 'tsoc.nome as status', 'status');
        $this->makereport->addField('categoria', 'Categoria', 'coc.nome as categoria', 'categoria');
        $this->makereport->addField('vencimento', 'Vencimento', "DATE_FORMAT(oc.vencimento, '%d/%m/%Y') as vencimento", 'vencimento');
        $this->makereport->addField('valor', 'Valor', 'soc.valor', NULL);
        $this->makereport->addField('protocolo', 'Protocolo', 'oc.protocolo', NULL);

        $contas         = $this->makereport->getContas();
		$displayFiltros = $this->makereport->getDisplayFiltros();
        $campos         = $this->makereport->getFields();
        $total          = $this->makereport->getTotais();

        return array(
            'filtrosAjax'    => $this->makereport->getFiltrosString(),
            'displayFiltros' => $displayFiltros,
            'contas'         => $contas,
            'campos'         => $campos,
            'total'          => $total
        );
    }
}
?>
