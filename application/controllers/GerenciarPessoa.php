<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GerenciarPessoa extends CI_Controller
{
    private $pessoas;
    
    public function __construct()
    {
        parent::__construct();

        // SubMenu
        $this->submenu->addItem('Novo', '/GerenciarPessoa/editar', 'novo');
        $this->submenu->addItem('Busca', '/GerenciarPessoa/buscar', 'buscar');
        $this->submenu->addItem('Lista', '/GerenciarPessoa/listar', 'listar');

        // Ações
        $this->acoes->addItem('Alterar pessoa', '/GerenciarPessoa/editar', 'alterar');
        $this->acoes->addItem('Excluir pessoa', '/GerenciarPessoa/excluir', 'excluir');
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

        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->library('BasicForm');

        $nome = $sobrenome = $sexo = NULL;
        if(isset($id) && !empty($id)) {
            $this->load->model('Pessoa');
            $pessoa = $this->Pessoa->getById($id);
            $titulo = "Alterar cadastro de {$pessoa->nome}";
        } else {
            $titulo = 'Novo cadastro de pessoa';
        }

        $tiposOsseos = array(
            'fino'  => 'Fino',
            'medio' => 'Médio',
            'largo' => 'Largo'
        );

        $sexoImagem = (isset($pessoa)) ? strtolower($pessoa->sexo) : 'masculino';

        $this->basicform->addInput('Nome: ', 'nome', 'nome', '', isset($pessoa) ? $pessoa->nome: NULL);
        $this->basicform->addInput('Sobrenome: ', 'sobrenome', 'sobrenome', '', isset($pessoa) ? $pessoa->sobrenome : NULL);
        $formRadio = $this->basicform->addRadio('Sexo: ', 'sexo', 'sexo');
        $formRadio->addItem('Masculino', 'sexo', 'MasculinoId', 'Masculino', '', isset($pessoa) ? $pessoa->sexo : NULL);
        $formRadio->addItem('Feminino', 'sexo', 'FemininoId', 'Feminino', '', isset($pessoa) ? $pessoa->sexo : NULL);
        $formRadioImage = $this->basicform->addRadioImage('Estrutura comportal (tipo osseo): ', 'tipo_osseo', 'tipo_osseo');
        foreach ($tiposOsseos as $key => $tipoOsseo) {
            $formRadioImage->addItem("{$key}_{$sexoImagem}", 'tipo_osseo', "{$tipoOsseo}Id", strtolower($tipoOsseo), '', isset($pessoa) ? $pessoa->tipo_osseo : NULL);
        }

        $this->load->view('principal', array(
            'template' => 'form',
            'titulo'   => $titulo,
            'dados'    => array(
                'action' => '/GerenciarPessoa/salvar',
                'submit' => 'Salvar',
                'id'     => $id
            )
        ));
    }

    public function salvar()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('sobrenome', 'Sobrenome', 'required');
        $this->form_validation->set_rules('sexo', 'Sexo', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->editar();
        } else {
            $this->load->model('Pessoa');

            if (isset($_POST['id'])) {
                $this->Pessoa->atualizar($_POST);
            } else {
                $this->Pessoa->inserir($_POST);
            }
            $this->listar();
        }

    }

    public function listar($campo = NULL, $ordem = NULL)
    {
        $this->load->model('Pessoa');
        $this->load->library('Titulos');

        $this->titulos->addItem('Nome', '/GerenciarPessoa/listar', 'nome', 'ASC', 'none');
        $this->titulos->addItem('Sobrenome', '/GerenciarPessoa/listar', 'sobrenome', 'ASC', 'none');
        $this->titulos->addItem('Sexo', '/GerenciarPessoa/listar', 'sexo', 'ASC', 'none');
        $this->titulos->addItem('A&ccedil;&otilde;es');

        if (isset($campo) && isset($ordem)) {
            $this->titulos->change($campo, $ordem);
        }

        if (!isset($this->pessoas)) {
            $pessoas = $this->Pessoa->listar($campo, $ordem);
        } else {
            $pessoas = $this->pessoas;
        }

        $this->load->view('principal', array(
            'template' => 'GerenciarPessoa/listar',
            'titulo'   => 'Lista pessoas',
            'dados'    => array(
                'pessoas' => $pessoas
            )
        ));
    }

    public function buscar()
    {
        $this->load->helper('form');
        $this->load->library('BasicForm');
        $this->basicform->addInput('', 'dado', 'dado', '', '');
        $this->load->view('principal', array(
            'template' => 'form',
            'titulo'   => 'Buscar pessoa',
            'dados'    => array(
                'action' => '/GerenciarPessoa/efetuarBusca',
                'submit' => 'Buscar',
                'class'  => 'buscar'
            )
        ));
    }

    public function efetuarBusca()
    {
        $this->load->model('Pessoa');
        $pessoas = $this->Pessoa->buscar($this->input->post('dado'));
        $this->pessoas = $pessoas;
        $this->listar();
    }

    public function excluir($id)
    {
        $this->load->model('Pessoa');
        $this->Pessoa->excluir($id);
        $this->listar();
    }
}
?>
