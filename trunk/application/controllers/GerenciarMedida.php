<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GerenciarMedida extends CI_Controller
{
    private $medidas;
    
    public function __construct()
    {
        parent::__construct();

        // SubMenu
        $this->submenu->addItem('Novo', '/GerenciarMedida/editar');
        $this->submenu->addItem('Busca', '/GerenciarMedida/buscar');
        $this->submenu->addItem('Gráfico', '/GerenciarMedida/grafico');

        // Ações
        $this->acoes->addItem('[ A ]', '/GerenciarMedida/editar');
        $this->acoes->addItem('[ X ]', '/GerenciarMedida/excluir', TRUE);
    }

    public function index()
    {
        $this->grafico();
    }

    public function grafico()
    {
        $titulo = 'Gráfico';

        $this->load->view('principal', array(
            'template' => '/GerenciarMedida/grafico',
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

        $medida = NULL;
        if(isset($id) && !empty($id)) {
            $this->load->model('Medida');
            $medida = $this->Medida->getById($id);
            $titulo = 'Alterar Medida';
        } else {
            $titulo = 'Inserir Medida';
        }

        $this->load->model('Pessoa');
        $pessoas = $this->Pessoa->getOptionsForDropdown();

        $this->basicform->addDropdown('Pessoa: ', 'pessoa_id', 'pessoa_id', isset($medida) ? $medida->pessoa_id: NULL, $pessoas);
        $this->basicform->addInput('Data: ', 'data', 'data', 'data', isset($medida) ? $medida->data: date('d/m/Y'));
        $this->basicform->addInput('Altura: ', 'altura', 'altura', '', isset($medida) ? $medida->altura : NULL);
        $this->basicform->addInput('Peso: ', 'peso', 'peso', '', isset($medida) ? $medida->peso : NULL);

        $this->load->view('principal', array(
            'template' => 'form',
            'titulo'   => $titulo,
            'dados'    => array(
                'action' => '/GerenciarMedida/salvar',
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
        $this->form_validation->set_rules('altura', 'Altura', 'required');
        $this->form_validation->set_rules('peso', 'Peso', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->editar();
        } else {
            $this->load->model('Medida');

            if (isset($_POST['id'])) {
                $id = $this->Medida->atualizar($_POST);
            } else {
                $id = $this->Medida->inserir($_POST);
            }
            $this->efetuarBusca($id);
        }

    }

    public function listar($campo = NULL, $ordem = NULL)
    {
        $this->load->model('Medida');
        $this->load->library('Titulos');

        $this->titulos->addItem('Pessoa', '/GerenciarMedida/listar', 'nome', 'ASC', 'none');
        $this->titulos->addItem('Data', '/GerenciarMedida/listar', 'data', 'ASC', 'none');
        $this->titulos->addItem('Altura', '/GerenciarMedida/listar', 'altura', 'ASC', 'none');
        $this->titulos->addItem('Peso', '/GerenciarMedida/listar', 'peso', 'ASC', 'none');
        $this->titulos->addItem('A&ccedil;&otilde;es');

        if (isset($campo) && isset($ordem)) {
            $this->titulos->change($campo, $ordem);
        }

        if (!isset($this->medidas)) {
            $medidas = $this->Medida->listar($campo, $ordem);
        } else {
            $medidas = $this->medidas;
        }

        $this->load->view('principal', array(
            'template' => 'GerenciarMedida/listar',
            'titulo'   => 'Lista de medidas encontradas',
            'dados'    => array(
                'medidas' => $medidas
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
            'titulo'   => 'Buscar medida',
            'dados'    => array(
                'action' => '/GerenciarMedida/efetuarBusca',
                'submit' => 'Buscar'
            )
        ));
    }

    public function efetuarBusca($id = NULL)
    {
        $this->load->model('Medida');
        if (isset($id)) {
            $medidas = $this->Medida->buscar($id);
        } else {
            $medidas = $this->Medida->buscar($this->input->post('dado'));
        }
        $this->medidas = $medidas;
        $this->listar();
    }

    public function excluir($id)
    {
        $this->load->model('Medida');
        $this->Medida->excluir($id);
        $this->buscar();
    }
}
?>
