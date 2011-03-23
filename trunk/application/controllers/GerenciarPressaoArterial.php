<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GerenciarPressaoArterial extends CI_Controller
{
    private $pressaoArterials;
    
    public function __construct()
    {
        parent::__construct();

        // SubMenu
        $this->submenu->addItem('Novo', '/GerenciarPressaoArterial/editar');
        $this->submenu->addItem('Busca', '/GerenciarPressaoArterial/buscar');
        $this->submenu->addItem('Gráfico', '/GerenciarPressaoArterial/grafico');

        // Ações
        $this->acoes->addItem('[ A ]', '/GerenciarPressaoArterial/editar');
        $this->acoes->addItem('[ X ]', '/GerenciarPressaoArterial/excluir', TRUE);
    }

    public function index()
    {
        $this->grafico();
    }

    public function grafico()
    {
        $titulo = 'Gráfico';

        $this->load->view('principal', array(
            'template' => '/GerenciarPressaoArterial/grafico',
            'titulo'   => $titulo,
        ));
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

        $pressaoArterial = NULL;
        if(isset($id) && !empty($id)) {
            $this->load->model('PressaoArterial');
            $pressaoArterial = $this->PressaoArterial->getById($id);
            $titulo = 'Alterar Pressão Arterial';
        } else {
            $titulo = 'Inserir Pressão Arterial';
        }

        $this->load->model('Pessoa');
        $pessoas = $this->Pessoa->getOptionsForDropdown();

        $posicoes = array(
            ''        => '-------',
            'Em pé'   => 'Em pé',
            'Sentado' => 'Sentado',
            'Deitado' => 'Deitado'
        );

        $this->basicform->addDropdown('Pessoa: ', 'pessoa_id', 'pessoa_id', isset($pressaoArterial) ? $pressaoArterial->pessoa_id: NULL, $pessoas);
        $this->basicform->addInput('Data: ', 'data', 'data', 'data', isset($pressaoArterial) ? $pressaoArterial->data: date('d/m/Y'));
        $this->basicform->addInput('Hora: ', 'hora', 'hora', '', isset($pressaoArterial) ? $pressaoArterial->hora: date('H:i:s'));
        $this->basicform->addInput('Sistólica: ', 'sistolica', 'sistolica', '', isset($pressaoArterial) ? $pressaoArterial->sistolica : NULL);
        $this->basicform->addInput('Diastólica: ', 'diastolica', 'diastolica', '', isset($pressaoArterial) ? $pressaoArterial->diastolica : NULL);
        $this->basicform->addDropdown('Posição: ', 'posicao', 'posicao', isset($pressaoArterial) ? $pressaoArterial->posicao : NULL, $posicoes);
        $this->basicform->addInput('Em Atividade? ', 'em_atividade', 'em_atividade', '', isset($pressaoArterial) ? $pressaoArterial->em_atividade : NULL);

        $this->load->view('principal', array(
            'template' => 'form',
            'titulo'   => $titulo,
            'dados'    => array(
                'action' => '/GerenciarPressaoArterial/salvar',
                'submit' => 'Salvar',
                'id'     => $id
            )
        ));
    }

    public function salvar()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('pessoa_id', 'Pessoa', 'required');
        $this->form_validation->set_rules('data', 'Data', 'required');
        $this->form_validation->set_rules('hora', 'Hora', 'required');
        $this->form_validation->set_rules('sistolica', 'Sistólica', 'required');
        $this->form_validation->set_rules('diastolica', 'Diastólica', 'required');
        $this->form_validation->set_rules('posicao', 'Posição', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->editar();
        } else {
            $this->load->model('PressaoArterial');

            if (isset($_POST['id'])) {
                $id = $this->PressaoArterial->atualizar($_POST);
            } else {
                $id = $this->PressaoArterial->inserir($_POST);
            }
            $this->efetuarBusca($id);
        }

    }

    public function listar($campo = NULL, $ordem = NULL)
    {
        $this->load->model('PressaoArterial');
        $this->load->library('Titulos');

        $this->titulos->addItem('Pessoa', '/GerenciarPressaoArterial/listar', 'nome', 'ASC', 'none');
        $this->titulos->addItem('Data', '/GerenciarPressaoArterial/listar', 'data', 'ASC', 'none');
        $this->titulos->addItem('Hora', '/GerenciarPressaoArterial/listar', 'hora', 'ASC', 'none');
        $this->titulos->addItem('Diastólica', '/GerenciarPressaoArterial/listar', 'diastolica', 'ASC', 'none');
        $this->titulos->addItem('Sistólica', '/GerenciarPressaoArterial/listar', 'sistolica', 'ASC', 'none');
        $this->titulos->addItem('Posição', '/GerenciarPressaoArterial/listar', 'posicao', 'ASC', 'none');
        $this->titulos->addItem('Em Atividade?', '/GerenciarPressaoArterial/listar', 'em_atividade', 'ASC', 'none');
        $this->titulos->addItem('A&ccedil;&otilde;es');

        if (isset($campo) && isset($ordem)) {
            $this->titulos->change($campo, $ordem);
        }

        if (!isset($this->pressaoArterials)) {
            $pressaoArterials = $this->PressaoArterial->listar($campo, $ordem);
        } else {
            $pressaoArterials = $this->pressaoArterials;
        }

        $this->load->view('principal', array(
            'template' => 'GerenciarPressaoArterial/listar',
            'titulo'   => 'Lista de PAs encontradas',
            'dados'    => array(
                'pressaoArterials' => $pressaoArterials
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
            'titulo'   => 'Buscar Pressão Arterial',
            'dados'    => array(
                'action' => '/GerenciarPressaoArterial/efetuarBusca',
                'submit' => 'Buscar'
            )
        ));
    }

    public function efetuarBusca($id = NULL)
    {
        $this->load->model('PressaoArterial');
        if (isset($id)) {
            $pressaoArterials = $this->PressaoArterial->buscar($id);
        } else {
            $pressaoArterials = $this->PressaoArterial->buscar($this->input->post('dado'));
        }
        $this->pressaoArterials = $pressaoArterials;
        $this->listar();
    }

    public function excluir($id)
    {
        $this->load->model('PressaoArterial');
        $this->PressaoArterial->excluir($id);
        $this->buscar();
    }
}
?>
