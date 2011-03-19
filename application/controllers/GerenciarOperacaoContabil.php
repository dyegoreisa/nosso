<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GerenciarOperacaoContabil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // SubMenu
        $this->submenu->addItem('Novo', '/GerenciarOperacaoContabil/editar');
        $this->submenu->addItem('Busca', '/GerenciarOperacaoContabil/buscar');
        $this->submenu->addItem('Lista', '/GerenciarOperacaoContabil/listar');

        // Ações
        $this->acoes->addItem('[ A ]', '/GerenciarOperacaoContabil/editar');
        $this->acoes->addItem('[ S ]', '/GerenciarOperacaoContabil/selecionarStatus');
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
            $this->load->model('OperacaoContabil');
            $operacaoContabil = $this->OperacaoContabil->getById($id);
            $titulo = "Alterar cadastro da conta {$operacaoContabil->categoria}";
        } else {
            $titulo = 'Novo cadastro de conta';
        }

        $this->load->model('TipoOperacaoContabil');
        $tipoOpcoes = $this->TipoOperacaoContabil->listar();

        $this->load->model('CategoriaOperacaoContabil');
        $categoriaOpcoes = $this->CategoriaOperacaoContabil->getOptionsForDropdown();

        $formRadio = $this->basicform->addRadio('Tipo: ', 'tipo_operacao_contabil_id', 'tipo_operacao_contabil_id');
        foreach ($tipoOpcoes as $opcao) {
            $formRadio->addItem($opcao->nome, 'tipo_operacao_contabil_id', $opcao->nome.$opcao->id, $opcao->id, isset($operacaoContabil) ? $operacaoContabil->tipo_operacao_contabil_id : NULL);
        }

        $this->basicform->addDropdown('Categoria: ', 'categoria_operacao_contabil_id', 'categoria_operacao_contabil_id',
            isset($operacaoContabil) ? $operacaoContabil->categoria_operacao_contabil_id: NULL, $categoriaOpcoes);

        $this->basicform->addInput('Valor: ', 'valor', 'valor', '', isset($operacaoContabil) ? $operacaoContabil->valor : NULL);
        $this->basicform->addInput('Vencimento: ', 'vencimento', 'vencimento', 'data', isset($operacaoContabil) ? $operacaoContabil->vencimento : NULL);
        $this->basicform->addInput('Protocolo: ', 'protocolo', 'protocolo', '', isset($operacaoContabil) ? $operacaoContabil->protocolo : NULL);

        if(!isset($id) || empty($id)) {
            $this->basicform->addCheckbox('Estimativa: ', 'estimativa', 'estimativa', 1, '');
        }

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

        $this->form_validation->set_rules('tipo_operacao_contabil_id', 'Tipo', 'required');
        $this->form_validation->set_rules('categoria_operacao_contabil_id', 'Categoria', 'required');
        $this->form_validation->set_rules('valor', 'Valor', 'required');
        $this->form_validation->set_rules('vencimento', 'Vencimento', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->editar();
        } else {
            $this->load->model('OperacaoContabil');
            $this->load->model('TipoStatusOperacaoContabil');

            if (isset($_POST['id'])) {
                $this->OperacaoContabil->atualizar($_POST);
            } else {
                $this->load->model('TipoOperacaoContabil');

                if ($_POST['tipo_operacao_contabil_id'] === $this->TipoOperacaoContabil->getIdByName('Saída')) {
                    if (isset($_POST['estimativa']) && $_POST['estimativa'] == 1) {
                        $status = 'Estimativa';
                        unset($_POST['estimativa']);
                    } else {
                        $status = 'A pagar';
                    }
                } else {
                    $status = 'A receber';
                }

                $idTipoStatusOperacaoContabil = $this->TipoStatusOperacaoContabil->getIdByName($status);
                $this->OperacaoContabil->inserir($_POST, $idTipoStatusOperacaoContabil);
            }
            $this->listar();
        }

    }

    public function listar($operacoes = NULL, $dado = '')
    {
        $this->load->model('OperacaoContabil');

        if (!isset($operacoes)) {
            $operacoes = $this->OperacaoContabil->listar();
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

        $this->basicform->addInput('', 'dado', 'dado', 'data', '');
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
        $this->load->model('OperacaoContabil');
        $operacoes = $this->OperacaoContabil->buscar($this->input->post('dado'));
        $this->listar($operacoes, $this->input->post('dado'));
    }

    public function excluir($id)
    {
        $this->load->model('OperacaoContabil');
        $this->OperacaoContabil->excluir($id);
        $this->listar();
    }

    public function selecionarStatus($id, $idTipo)
    {
        $this->load->helper('form');
        $this->load->library('BasicForm');

        $this->load->model('TipoStatusOperacaoContabil');
        $statusOperacoes = $this->TipoStatusOperacaoContabil->getOptionsForDropdown($idTipo);

        $this->load->model('OperacaoContabil');
        $operacaoContabil = $this->OperacaoContabil->getById($id);

        $valor = number_format($operacaoContabil->valor, 2, ',', '.');

        $titulo = "{$operacaoContabil->tipo} <br/>
        {$operacaoContabil->categoria} -
        {$operacaoContabil->protocolo} <br/>
        R$ {$valor} com vencimento em 
        {$operacaoContabil->vencimento} <br/>
        {$operacaoContabil->status}";
        $this->basicform->addLabel($titulo, 'label_long');
        $this->basicform->addDropdown('Status: ', 'status', 'status', '', $statusOperacoes);
        $this->basicform->addInput('Valor: ', 'valor', 'valor', '', $operacaoContabil->valor);
        $this->basicform->addHidden('id_tipo', $idTipo);

        $this->load->view('principal', array(
            'template' => 'form',
            'titulo'   => "Alterar status da conta",
            'dados'    => array(
                'action' => '/GerenciarOperacaoContabil/alterarStatus',
                'submit' => 'Alterar',
                'id'     => $id
            )
        ));
    }

    public function alterarStatus()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->selecionarStatus($this->input->post('id'), $this->input->post('id_tipo'));
        } else {
            $id       = $this->input->post('id'); 
            $idStatus = $this->input->post('status');
            $valor    = $this->input->post('valor');

            $this->load->model('StatusOperacaoContabil');
            $this->StatusOperacaoContabil->alterarStatus($id, $idStatus, $valor);

            $this->listar();
        }
    }
}
?>