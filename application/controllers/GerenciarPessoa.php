<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GerenciarPessoa extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		// SubMenu
		$this->submenu->addItem('Novo', '/GerenciarPessoa/editar');
		$this->submenu->addItem('Buscar', '/GerenciarPessoa/buscar');
		$this->submenu->addItem('Listar', '/GerenciarPessoa/listar');
	}

	public function index()
	{
		$this->listar();
	}

	public function editar($id = null)
	{
		$this->load->helper('form');
		$this->load->library('BasicForm');

		$this->basicform->addInput('Nome: ', 'nome', 'nome', set_value('nome'));
		$this->basicform->addInput('Sobrenome: ', 'sobrenome', 'sobrenome', set_value('sobrenome'));
		$formRadio = $this->basicform->addRadio('Sexo: ', 'sexo', 'sexo');
		$formRadio->addItem('Masculino', 'sexo', 'MasculinoId', 'Masculino', set_radio('sexo', 'Masculino'));
		$formRadio->addItem('Feminino', 'sexo', 'FemininoId', 'Feminino', set_radio('sexo', 'Feminino'));

		if(isset($id) && !empty($id)) {
			$titulo = 'Alterar cadastro de [fulado]';
		} else {
			$titulo = 'Novo cadastro de pessoa';
		}

		$this->load->view('principal', array(
			'template' => 'form',
			'titulo'   => $titulo,
			'dados'    => array(
				'action' => '/GerenciarPessoa/salvar',
				'submit' => 'Salvar'
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

			$this->load->model('pessoa');

			$this->pessoa->salvar($_POST);

			$this->listar();
		}

	}

	public function listar()
	{
		$this->load->model('pessoa');

		$this->load->view('principal', array(
			'template' => 'GerenciarPessoa/listar',
			'titulo'   => 'Lista pessoas',
			'dados'	   => array(
				'pessoas' => $this->pessoa->listar()
			)
		));
	}
}
?>
