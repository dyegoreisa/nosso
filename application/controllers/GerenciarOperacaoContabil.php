<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GerenciarOperacaoContabil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // SubMenu
        $this->submenu->addItem('Novo', '/GerenciarOperacaoContabil/editar');
        $this->submenu->addItem('Buscar', '/GerenciarOperacaoContabil/buscar');
        $this->submenu->addItem('Listar', '/GerenciarOperacaoContabil/listar');

        // Ações
        $this->acoes->addItem('[ A ]', '/GerenciarOperacaoContabil/editar');
        $this->acoes->addItem('[ X ]', '/GerenciarOperacaoContabil/excluir', TRUE);
    }

    public function index()
    {
        $this->listar();
    }

    public function editar($id = NULL)
    {
        if (!isset($id)) {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
            }
        }

        $this->load->helper('form');
        $this->load->library('BasicForm');

        $nome = $sobrenome = $sexo = NULL;
        if(isset($id) && !empty($id)) {
            $this->load->model('operacaoContabil');
            $operacaoContabil = $this->operacaocontabil->getById($id);
            $titulo = "Alterar cadastro da conta {$operacaoContabil->protocolo}";
        } else {
            $titulo = 'Novo cadastro de conta';
        }

        $this->basicform->addInput('Tipo: ', 'tipo_operacao_contabil_id', 'tipo_operacao_contabil_id', isset($operacaoContabil) ? $operacaoContabil->tipo_operacao_contabil_id: NULL);
        $this->basicform->addInput('Valor: ', 'valor', 'valor', isset($operacaoContabil) ? $operacaoContabil->valor : NULL);
		$this->basicform->addInput('Protocolo: ', 'protocolo', 'protocolo', isset($operacaoContabil) ? $operacaoContabil->protocolo : NULL);

        $this->load->view('principal', array(
            'template' => 'form',
            'titulo'   => $titulo,
            'dados'    => array(
                'action' => '/GerenciarOperacaoContabil/salvar',
                'submit' => 'Salvar',
                'id'     => $id
            )
        ));
    }

    public function salvar()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('tipo_operacao_contabil', 'Tipo', 'required');
        $this->form_validation->set_rules('valor', 'Valor', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->editar();
        } else {
            $this->load->model('operacaoContabil');

            if (isset($_POST['id'])) {
                $this->operacaocontabil->atualizar($_POST);
            } else {
                $this->operacaocontabil->inserir($_POST);
            }
            $this->listar();
        }

    }

    public function listar($operacoes = NULL, $dado = '')
    {
        $this->load->model('operacaocontabil');

        if (!isset($operacoes)) {
            $operacoes = $this->operacaocontabil->listar();
        }

        $this->load->view('principal', array(
            'template' => 'GerenciarOperacaoContabil/listar',
            'titulo'   => 'Lista de contas',
            'dados'       => array(
                'operacoes' => $operacoes
            )
        ));
    }

    public function buscar()
    {
        $this->load->helper('form');
        $this->load->library('BasicForm');
        $this->basicform->addInput('', 'dado', 'dado', '');
        $this->load->view('principal', array(
            'template' => 'form',
            'titulo'   => 'Buscar conta',
            'dados'    => array(
                'action' => '/GerenciarOperacaoContabil/efetuarBusca',
                'submit' => 'Buscar'
            )
        ));
    }

    public function efetuarBusca()
    {
        $this->load->model('operacaoContabil');
        $operacoes = $this->operacaocontabil->buscar($this->input->post('dado'));
        $this->listar($operacoes, $this->input->post('dado'));
    }

    public function excluir($id)
    {
        $this->load->model('operacaoContabil');
        $this->operacaocontabil->excluir($id);
        $this->listar();
    }
}
?>