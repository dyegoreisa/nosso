<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TipoOperacaoContabil extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function listar()
    {
        $this->db->order_by('nome');
        $query = $this->db->get('tipo_operacao_contabil');

        return $query->result();
    }

    public function inserir(array $dados)
    {
        $this->db->insert('tipo_operacao_contabil', $dados);
    }

    public function atualizar(array $dados)
    {
        $id = $dados['id'];
        unset($dados['id']);
        $this->db->where('id', $id);
        $this->db->update('tipo_operacao_contabil', $dados);
    }

    public function getById($id)
    {
        $query = $this->db->get_where('tipo_operacao_contabil', array('id' => $id));
        $operacao = $query->result();
        return $operacao[0];
    }

    public function buscar($dado)
    {
        $this->db->select('*')->from('tipo_operacao_contabil')->like($dado);
        $query = $this->db->get();
        return $query->result();
    }

    public function excluir($id)
    {
        $this->db->delete('tipo_operacao_contabil', array('id' => $id));
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

    public function getIdByName($nome)
    {
        $query = $this->db->get_where('tipo_operacao_contabil', array('nome' => $nome));
        $tipo_operacao_contabil = $query->result();
        return $tipo_operacao_contabil[0]->id;
    }
}
?>
