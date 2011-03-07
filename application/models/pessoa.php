<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pessoa extends CI_Model
{ 
	public function __construct()
	{
		parent::__construct(); 
	}

	public function listar()
	{
		$query = $this->db->get('pessoa');

		return $query->result();
	}

	public function salvar(array $dados)
	{
		$this->db->insert('pessoa', $dados);
	}
}
?>
