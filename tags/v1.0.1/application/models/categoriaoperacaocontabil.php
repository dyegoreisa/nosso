<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CategoriaOperacaoContabil extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function listar()
    {
        $this->db->order_by('nome');
        $query = $this->db->get('categoria_operacao_contabil');

        return $query->result();
    }

    public function inserir(array $dados)
    {
        $this->db->insert('categoria_operacao_contabil', $dados);
    }

    public function atualizar(array $dados)
    {
        $id = $dados['id'];
        unset($dados['id']);
        $this->db->where('id', $id);
        $this->db->update('categoria_operacao_contabil', $dados);
    }

    public function getById($id)
    {
        $query = $this->db->get_where('categoria_operacao_contabil', array('id' => $id));
        $operacao = $query->result();
        return $operacao[0];
    }

    public function buscar($dado)
    {
        $this->db->select('*')->from('categoria_operacao_contabil')->like($dado);
        $query = $this->db->get();
        return $query->result();
    }

    public function excluir($id)
    {
        $this->db->delete('categoria_operacao_contabil', array('id' => $id));
    }

    public function getOptionsForDropdown()
    {
        $tipos = array('' => '------');
        $result = $this->listar();
        foreach ($result as $tipo) {
            $tipos[$tipo->id] = $tipo->nome;
        }
        return $tipos;
    }
}
?>
