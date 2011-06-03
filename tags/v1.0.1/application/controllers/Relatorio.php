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

        $this->basicform->addInput('Data Incial: ', 'data_inicio', 'data_inicio', 'data', '');
        $this->basicform->addInput('Data Final: ', 'data_fim', 'data_fim', 'data', '');
        $this->basicform->addCheckbox('Mostrar contar atrasadas?: ', 'mostrar_atrasadas', 'mostrar_atrasadas', TRUE, '');

        $this->load->view('principal', array(
            'template' => 'form',
            'titulo'   => 'Relatório de contas',
            'dados'    => array(
                'action' => '/Relatorio/executar',
                'submit' => 'Gerar'
            )
        ));
    }

    public function executarAjax($dataInicio = NULL, $dataFim = NULL, $mostrarAtrasadas = FALSE)
    {
        $this->ajax = TRUE;
        $this->executar($dataInicio, $dataFim, $mostrarAtrasadas);
    }

    public function executar($dataInicio = NULL, $dataFim = NULL, $mostrarAtrasadas = FALSE)
    {
        $dados = $this->process($dataInicio, $dataFim, $mostrarAtrasadas);
        if (isset($this->ajax) && $this->ajax == TRUE) {
            $this->load->view('Relatorio/dados', $dados);
        } elseif (isset($dataInicio) && isset($dataFim)) {
            $this->renderPrincipal($dados);
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('data_inicio', 'Data Incial', 'required');

            if ($this->form_validation->run() === FALSE) {
                $this->index();
            } else {
                $this->renderPrincipal($dados);
            }
        }
    }

    private function renderPrincipal($dados)
    {
        $this->load->view('principal', array(
            'template' => 'Relatorio/resultado',
            'titulo'   => 'Relatório de contas',
            'js'       => TRUE,
            'dados'    => $dados
        ));
    }

    private function process($dataInicio, $dataFim, $mostrarAtrasadas = FALSE)
    {
        $this->load->helper('html');
        $this->load->library('Report/MakeReport');

        // Filtros
        if (!isset($dataInicio) && !isset($dataFim)) {
            $dataInicio       = $this->input->post('data_inicio');
            $dataFim          = $this->input->post('data_fim');
            $dataFim          = (empty($dataFim)) ? '99/99/9999' : $this->input->post('data_fim');
            $mostrarAtrasadas = (boolean)$this->input->post('mostrar_atrasadas');
        }
        $this->makereport->addFiltro('data_inicio', $dataInicio, TRUE);
        $this->makereport->addFiltro('data_fim', $dataFim, TRUE);
        $this->makereport->setAPagar($mostrarAtrasadas == 'true' ? TRUE : FALSE);

        // Campos
        $this->makereport->addField('tipo', 'Tipo', 'toc.nome AS tipo', 'tipo');
        $this->makereport->addField('status', 'Status', 'tsoc.nome AS status', 'status');
        $this->makereport->addField('categoria', 'Categoria', 'coc.nome AS categoria', 'categoria');
        $this->makereport->addField('vencimento', 'Vencimento', "DATE_FORMAT(oc.vencimento, '%d/%m/%Y') AS vencimento", 'vencimento');
        $this->makereport->addField('valor', 'Valor', 'soc.valor', NULL);
        $this->makereport->addField('protocolo', 'Protocolo', 'oc.protocolo', NULL);

        $contas         = $this->makereport->getContas();
		$displayFiltros = $this->makereport->getDisplayFiltros();
        $campos         = $this->makereport->getFields();
        $total          = $this->makereport->getTotais();
        $atrasadas      = ($mostrarAtrasadas == 'true') ? 'checked="checked"' : '';

        return array(
            'filtrosAjax'    => $this->makereport->getFiltrosString(),
            'displayFiltros' => $displayFiltros,
            'contas'         => $contas,
            'campos'         => $campos,
            'total'          => $total,
            'atrasadas'      => $atrasadas
        );
    }
}
?>
