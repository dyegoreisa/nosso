<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GerenciarReceituario extends CI_Controller
{
    private $receituarios;
    
    public function __construct()
    {
        parent::__construct();

        // SubMenu
        $this->submenu->addItem('Novo', '/GerenciarReceituario/editar', 'novo');
        $this->submenu->addItem('Busca', '/GerenciarReceituario/buscar', 'buscar');
        $this->submenu->addItem('Lista', '/GerenciarReceituario/listar', 'listar');

        // Ações
        $this->acoes->addItem('Alterar receituario', '/GerenciarReceituario/editar', 'alterar');
        $this->acoes->addItem('Excluir receituario', '/GerenciarReceituario/excluir', 'excluir');
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
        $this->load->helper('file');
        $this->load->library('BasicForm');

        $mostrarImagem = $nome = $sobrenome = $sexo = NULL;
        if(isset($id) && !empty($id)) {
            $this->load->model('Receituario');
            $this->load->model('Imagem');

            $receituario = $this->Receituario->getById($id);

            $titulo = "Alterar cadastro de {$receituario->sintomas}";
        } else {
            $titulo = 'Novo cadastro de receituario';
        }

        $this->load->model('Pessoa');
        $pessoas = $this->Pessoa->getOptionsForDropdown();

        $this->basicform->addDropdown('Pessoa: ', 'pessoa_id', 'pessoa_id', isset($receituario) ? $receituario->pessoa_id: NULL, $pessoas);
        $this->basicform->addTextArea('Sintomas: ', 'sintomas', 'sintomas', '', isset($receituario) ? $receituario->sintomas: NULL);
        $this->basicform->addInput('Data dos Sintomas: ', 'data_sintoma', 'data_sintoma', 'data', isset($receituario) ? $receituario->data_sintoma : NULL);
        $this->basicform->addTextArea('Medicação: ', 'medicacao', 'medicacao', '', isset($receituario) ? $receituario->medicacao : NULL);
        $this->basicform->addInput('Data da melhora: ', 'data_melhora', 'data_melhora', 'data', isset($receituario) ? $receituario->data_melhora : NULL);
        $this->basicform->addCheckbox('Funcionou? ', 'funcionou', 'funcionou', '1', isset($pressaoArterial) ? $pressaoArterial->funcionou : NULL);


        $this->load->view('principal', array(
            'template' => 'form',
            'titulo'   => $titulo,
            'dados'    => array(
                'action' => '/GerenciarReceituario/salvar',
                'submit' => 'Salvar',
                'file'   => TRUE,
                'id'     => $id
            )
        ));
    }

    public function salvar()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('pessoa_id', 'Pessoa', 'required');
        $this->form_validation->set_rules('sintomas', 'Sintomas', 'required');
        $this->form_validation->set_rules('data_sintoma', 'Data dos Sintomas', 'required');
        $this->form_validation->set_rules('medicacao', 'Medicação');
        $this->form_validation->set_rules('data_melhora', 'Data da melhora');
        

        if ($this->form_validation->run() === FALSE) {
            $this->editar();
        } else {
            $this->load->model('Imagem');
            $this->load->model('Receituario');

            if (isset($_POST['id'])) {
                $this->Receituario->atualizar($_POST);
            } else {
                $this->Receituario->inserir($_POST);
            }
            $this->listar();
        }

    }

    public function listar($campo = NULL, $ordem = NULL)
    {
        $this->load->model('Receituario');
        $this->load->library('Titulos');

        $this->titulos->addItem('Sintomas', '/GerenciarReceituario/listar', 'sintomas', 'ASC', 'none');
        $this->titulos->addItem('Data dos Sintomas', '/GerenciarReceituario/listar', 'data_sintoma', 'ASC', 'none');
        $this->titulos->addItem('Funcionou', '/GerenciarReceituario/listar', 'funcionou', 'ASC', 'none');
        $this->titulos->addItem('A&ccedil;&otilde;es');

        if (isset($campo) && isset($ordem)) {
            $this->titulos->change($campo, $ordem);
        }

        if (!isset($this->receituarios)) {
            $receituarios = $this->Receituario->listar($campo, $ordem);
        } else {
            $receituarios = $this->receituarios;
        }

        $this->load->view('principal', array(
            'template' => 'GerenciarReceituario/listar',
            'titulo'   => 'Lista receituarios',
            'dados'    => array(
                'receituarios' => $receituarios
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
            'titulo'   => 'Buscar receituario',
            'dados'    => array(
                'action' => '/GerenciarReceituario/efetuarBusca',
                'submit' => 'Buscar',
                'class'  => 'buscar'
            )
        ));
    }

    public function efetuarBusca()
    {
        $this->load->model('Receituario');
        $receituarios = $this->Receituario->buscar($this->input->post('dado'));
        $this->receituarios = $receituarios;
        $this->listar();
    }

    public function excluir($id)
    {
        $this->load->model('Receituario');
        $this->Receituario->excluir($id);
        $this->listar();
    }
}
?>
