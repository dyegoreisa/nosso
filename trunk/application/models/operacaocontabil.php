<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OperacaoContabil extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    public function listar()
    {
        $query = $this->db->get('operacao_contabil');

        return $query->result();
    }

    public function inserir(array $dados)
    {
        $this->db->insert('operacao_contabil', $dados);
    }

    public function atualizar(array $dados)
    {
        $id = $dados['id'];
        unset($dados['id']);
        $this->db->where('id', $id);
        $this->db->update('operacao_contabil', $dados);
    }

    public function getById($id)
    {
        $query = $this->db->get_where('operacao_contabil', array('id' => $id));
        $operacao = $query->result();
        return $operacao[0];
    }

    public function buscar($dado)
    {
        $this->db->select('*')->from('operacao_contabil')->or_like(array(
            'tipo_operacao_contabil' => $dado,
            'valor'                  => $dado,
            'protocolo'              => $dado
        ));
        $query = $this->db->get();
        return $query->result();
    }

    public function excluir($id)
    {
        $this->db->delete('operacao_contabil', array('id' => $id));
    }
}
?>
