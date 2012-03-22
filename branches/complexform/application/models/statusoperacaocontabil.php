<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class StatusOperacaoContabil extends CI_Model 
{ 
    public function __construct() 
    { 
        parent::__construct(); 
    } 

    public function listar()
    {
		$this->db->order_by('data_inicio');
        $query = $this->db->get('status_operacao_contabil');

        return $query->result();
    }

    public function inserir(array $dados)
    {
        $this->db->insert('status_operacao_contabil', $dados);
    }

    public function atualizar(array $dados)
    {
        $id = $dados['id'];
        unset($dados['id']);
        $this->db->where('id', $id);
        $this->db->update('status_operacao_contabil', $dados);
    }

    public function getById($id)
    {
        $query = $this->db->get_where('status_operacao_contabil', array('id' => $id));
        $status_operacao_contabil = $query->result();
        return $status_operacao_contabil[0];
    }

    public function buscar($dado)
    {
        $this->db->select('*')->from('status_operacao_contabil')->or_like(array(
            'data_inicio' => $dado,
            'data_fim'    => $dado
        ));
        $query = $this->db->get();
        return $query->result();
    }

    public function excluir($id)
    {
        $this->db->delete('status_operacao_contabil', array('id' => $id));
    }

    public function alterarStatus($id, $idStatus, $valor)
    {
        $agora = date('Y-m-d H:i:s');
         
        $this->db->trans_start();

        $this->db->where('data_fim', NULL);
        $this->db->where('operacao_contabil_id', $id);
        $this->db->update('status_operacao_contabil', array('data_fim' => $agora));

        $this->db->insert('status_operacao_contabil', array(
            'operacao_contabil_id'             => $id,
            'tipo_status_operacao_contabil_id' => $idStatus,
            'valor'                            => $valor,
            'data_inicio'					   => $agora
        ));

        $this->db->trans_complete();
    }
} 
?>
