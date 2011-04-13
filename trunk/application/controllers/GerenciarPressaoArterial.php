<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GerenciarPressaoArterial extends CI_Controller
{
    private $pressaoArterials;
    
    public function __construct()
    {
        parent::__construct();

        // SubMenu
        $this->submenu->addItem('Novo', '/GerenciarPressaoArterial/editar', 'novo');
        $this->submenu->addItem('Busca', '/GerenciarPressaoArterial/buscar', 'buscar');
        $this->submenu->addItem('Gráfico', '/GerenciarPressaoArterial/grafico', 'grafico');

        // Ações
        $this->acoes->addItem('Alterar pressão arterial', '/GerenciarPressaoArterial/editar', 'alterar');
        $this->acoes->addItem('Excluir pressão arterial', '/GerenciarPressaoArterial/excluir', 'excluir');
    }

    public function index()
    {
        $this->filtroGrafico();
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
            $titulo = 'Registrar Pressão Arterial';
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
        $this->basicform->addInput('Sistólica (máxima): ', 'sistolica', 'sistolica', '', isset($pressaoArterial) ? $pressaoArterial->sistolica : NULL);
        $this->basicform->addInput('Diastólica (mínima): ', 'diastolica', 'diastolica', '', isset($pressaoArterial) ? $pressaoArterial->diastolica : NULL);
        $this->basicform->addDropdown('Posição: ', 'posicao', 'posicao', isset($pressaoArterial) ? $pressaoArterial->posicao : NULL, $posicoes);
        $this->basicform->addCheckbox('Em Atividade? ', 'em_atividade', 'em_atividade', '1', isset($pressaoArterial) ? $pressaoArterial->em_atividade : NULL);

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
                $_POST['em_atividade'] = isset($_POST['em_atividade']) ? 1 : 0;
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

    public function filtroGrafico()
    {
        $this->load->helper('form');
        $this->load->library('BasicForm');

        $this->load->model('Pessoa');
        $pessoas = $this->Pessoa->getOptionsForDropdown();

        $this->basicform->addDropdown('Pessoa: ', 'pessoa_id', 'pessoa_id', isset($medida) ? $medida->pessoa_id: NULL, $pessoas);
        $this->basicform->addInput('Data inicio: ', 'data_inicio', 'data_inicio', 'data', isset($medida) ? $medida->data: NULL);
        $this->basicform->addInput('Data fim: ', 'data_fim', 'data_fim', 'data', isset($medida) ? $medida->data: NULL);

        $this->load->view('principal', array(
            'template' => 'form',
            'titulo'   => 'Gerar gráfico de MRPA',
            'dados'    => array(
                'action' => '/GerenciarPressaoArterial/grafico',
                'submit' => 'Gerar',
            )
        ));
    }

    public function grafico()
    {
        $regexData = '/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/([12][0-9]{3})$/';
        preg_replace($regexData, '\3-\2-\1', $this->input->post('data_inicio'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('pessoa_id', 'Pessoa', 'required');
        $this->form_validation->set_rules('data_inicio', 'Data inicio', 'required');
        $this->form_validation->set_rules('data_fim', 'Data fim', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->filtroGrafico();
        } else {

            $this->load->view('principal', array(
                'template' => '/GerenciarPressaoArterial/grafico',
                'titulo'   => 'Gráfico de MRPA',
                'dados'    => array(
                    'pessoa_id'   => $this->input->post('pessoa_id'),
                    'data_inicio' => preg_replace($regexData, '\3-\2-\1', $this->input->post('data_inicio')),
                    'data_fim'    => preg_replace($regexData, '\3-\2-\1', $this->input->post('data_fim'))
                )
            ));
        }
    }

    public function dataJson($pessoaId, $dataInicio, $dataFim)
    {
        include 'api/ofc/php-ofc-library/open-flash-chart.php';

        $regexData = '/^([12][0-9]{3})-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/';

        $this->load->model('PressaoArterial');
        $pa = $this->PressaoArterial->grafico($pessoaId, $dataInicio, $dataFim, 'pa');

        $this->load->model('Pessoa');
        $pessoa = $this->Pessoa->getById($pessoaId);

        $dataInicioF = preg_replace($regexData, '\3/\2/\1', $dataInicio);
        $dataFimF    = preg_replace($regexData, '\3/\2/\1', $dataFim);

        $this->load->library('Grafico');
        
        $this->grafico->setScale(5);

        $this->grafico->setTitulo("MRPA - {$pessoa->nome} - {$dataInicioF} à {$dataFimF}");

        $sistolicaControlada = $this->pressaoControlada($pa['sistolica'], 'sistolica');
        $this->grafico->addElement($sistolicaControlada, 'Sistolica controlada', '#556B2F');

        $diastolicaControlada = $this->pressaoControlada($pa['diastolica'], 'diastolica');
        $this->grafico->addElement($diastolicaControlada, 'Diatolica controlada', '#228B22'); 

        $this->grafico->addElement($pa['sistolica'], 'Sistolica', '#FF0000');
        $this->grafico->addElement($pa['diastolica'], 'Diastólica', '#A52A2A');

        $this->grafico->setLabels($pa['data'], 'Dias', '#A2ACBA');
        $this->grafico->render(); 
    }

    private function pressaoControlada($pa, $tipo)
    {
        $paControladas = array();
        for ($i = 0; $i < count($pa); $i++) {
            $paControladas['sistolica'][]  = 130;
            $paControladas['diastolica'][] = 85;
        }

        return $paControladas[$tipo];
    }
}
?>
