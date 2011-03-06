<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pessoa extends CI_Model
{ 
	public function __construct()
	{
		parent::__construct(); 
	}

	public function listar()
	{
		$query = $this->db->query("
			SELECT *
			FROM pessoa
		");

		return $query->result();
	}
}
?>
