<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OperacaoContabil extends CI_Model
{
    private $regexData;
    private $sqlBase;

    public function __construct()
    {
        parent::__construct();
        $this->regexData = '/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/([12][0-9]{3})$/';
        $this->sqlBase = "
            SELECT
                oc.id
                , DATE_FORMAT(oc.vencimento, '%d/%m/%Y') as vencimento
                , FORMAT(oc.valor, 2) as valor
                , oc.protocolo
                , toc.nome as tipo
                , tsoc.nome as status
            FROM operacao_contabil oc
                JOIN tipo_operacao_contabil toc ON toc.id = oc.tipo_operacao_contabil_id
                JOIN status_operacao_contabil soc ON soc.operacao_contabil_id = oc.id AND soc.data_fim IS NULL
                JOIN tipo_status_operacao_contabil tsoc ON tsoc.id = soc.tipo_status_operacao_contabil_id
        ";
    }
	
    public function listar()
    {
        $query = $this->db->query($this->sqlBase . ' ORDER BY toc.nome');

        return $query->result();
    }

    public function inserir(array $dados)
    {
        $dados['vencimento'] = preg_replace($this->regexData, '\3-\2-\1', $dados['vencimento']);

        $this->db->insert('operacao_contabil', $dados);
        $id = $this->db->insert_id();
        $this->db->insert('status_operacao_contabil', array(
            'operacao_contabil_id'             => $id,
            'tipo_status_operacao_contabil_id' => 1, // A pagar
            'data_inicio'					   => date('Y-m-d H:i:s')
        ));
    }

    public function atualizar(array $dados)
    {
        $id = $dados['id'];
        unset($dados['id']);
        $dados['vencimento'] = preg_replace($this->regexData, '\3-\2-\1', $dados['vencimento']);
        $this->db->where('id', $id);
        $this->db->update('operacao_contabil', $dados);
    }

    public function getById($id)
    {
        $query = $this->db->query($this->sqlBase . ' WHERE oc.id = ?', $id);

        $operacao = $query->result();
        return $operacao[0];
    }

    public function buscar($dado)
    {
        $vencimento = preg_replace($this->regexData, '\3-\2-\1', $dado);
        $valor      = $dado;
        $protocolo  = "%{$dado}%";
        $tipo       = "%{$dado}%";
        $status     = "%{$dado}%";

        $query = $this->db->query($this->sqlBase . '
            WHERE oc.vencimento = ?
                OR oc.valor = ?
                OR oc.protocolo like ?
                OR toc.nome like ?
                OR tsoc.nome like ?
            ORDER BY toc.nome
        ', array($vencimento, $valor, $protocolo, $tipo, $status));

        return $query->result();
    }

    public function excluir($id)
    {
        $this->db->delete('operacao_contabil', array('id' => $id));
    }
}
?>
