<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pessoa extends CI_Model
{ 
    public function __construct()
    {
        parent::__construct(); 
    }

    public function listar()
    {
		$this->db->order_by('nome');
        $query = $this->db->get('pessoa');

        return $query->result();
    }

    public function inserir(array $dados)
    {
        $this->db->insert('pessoa', $dados);
    }

    public function atualizar(array $dados)
    {
        $id = $dados['id'];
        unset($dados['id']);
        $this->db->where('id', $id);
        $this->db->update('pessoa', $dados);
    }

    public function getById($id)
    {
        $query = $this->db->get_where('pessoa', array('id' => $id));
        $pessoa = $query->result();
        return $pessoa[0];
    }

    public function buscar($dado)
    {
        $this->db->select('*')->from('pessoa')->or_like(array(
            'nome'      => $dado,
            'sobrenome' => $dado,
            'sexo'      => $dado
        ));
        $query = $this->db->get();
        return $query->result();
    }

    public function excluir($id)
    {
        $this->db->delete('pessoa', array('id' => $id));
    }
}
?>
