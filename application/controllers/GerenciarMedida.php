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
        $this->submenu->addItem('Gráfico', '/GerenciarMedida/filtroGrafico');

        // Ações
        $this->acoes->addItem('[ A ]', '/GerenciarMedida/editar');
        $this->acoes->addItem('[ X ]', '/GerenciarMedida/excluir', TRUE);
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
            'titulo'   => 'Gerar gráfico',
            'dados'    => array(
                'action' => '/GerenciarMedida/grafico',
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
                'template' => '/GerenciarMedida/grafico',
                'titulo'   => 'Gráfico',
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

        $this->load->model('Medida');
        $medidas = $this->Medida->grafico($pessoaId, $dataInicio, $dataFim, 'peso');

        $this->load->model('Pessoa');
        $pessoa = $this->Pessoa->getById($pessoaId);

        $chart = new open_flash_chart();

        $dataInicioF = preg_replace($regexData, '\3/\2/\1', $dataInicio);
        $dataFimF    = preg_replace($regexData, '\3/\2/\1', $dataFim);
        $title = new title( "Peso de {$pessoa->nome} - {$dataInicioF} e {$dataFimF}" );
        $title->set_style( "{font-size: 20px; color: #A2ACBA; text-align: center;}" );
        $chart->set_title( $title );

        $area = new area();
        $area->set_colour( '#5B56B6' );
        $area->set_values( $medidas['peso'] );
        $area->set_key( 'Peso', 12 );
        $chart->add_element( $area );

        $x_labels = new x_axis_labels();
        $x_labels->set_steps( 1 );
        $x_labels->set_vertical();
        $x_labels->set_colour( '#A2ACBA' );
        $x_labels->set_labels( $medidas['data'] );

        $x = new x_axis();
        $x->set_colour( '#A2ACBA' );
        $x->set_grid_colour( '#D7E4A3' );
        // Add the X Axis Labels to the X Axis
        $x->set_labels( $x_labels );

        $chart->set_x_axis( $x );

        //
        // LOOK:
        //
        $x_legend = new x_legend( 'Dias' );
        $x_legend->set_style( '{font-size: 20px; color: #778877}' );
        $chart->set_x_legend( $x_legend );

        //
        // remove this when the Y Axis is smarter
        //
        $y = new y_axis();
        $fator = 5;
        $y->set_range( min($medidas['peso']) - $fator, max($medidas['peso']) + $fator, $fator );
        $chart->add_y_axis( $y );

        echo $chart->toPrettyString();
    }
}
?>
