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

		$this->basicform->addInput('Nome: ', 'nome', 'nome', 'nome', '');
		$this->basicform->addInput('Sobrenome: ', 'sobrenome', 'sobrenome', 'sobrenome', '');
		$formRadio = $this->basicform->addRadio('Sexo: ', 'sexo', 'sexo', '');
		$formRadio->addItem('Masculino', 'sexo', 'MasculinoId', '');
		$formRadio->addItem('Feminino', 'sexo', 'FemininoId', '');

		if(isset($id) && !empty($id)) {
			$titulo = 'Alterar cadastro de [fulado]';
		} else {
			$titulo = 'Novo cadastro de pessoa';
		}

		$this->load->view('principal', array(
			'template' => 'GerenciarPessoa/editar',
			'titulo'   => $titulo,
			'dados'    => array(
				'action' => '/Gerenciar/salvar',
				'submit' => 'Salvar'
			)
		));
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
