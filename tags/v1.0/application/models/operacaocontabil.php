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
                , oc.tipo_operacao_contabil_id
                , oc.categoria_operacao_contabil_id
                , DATE_FORMAT(oc.vencimento, '%d/%m/%Y') AS vencimento
                , oc.vencimento AS venc_order
                , oc.protocolo
                , soc.valor
                , toc.nome AS tipo
                , coc.nome AS categoria
                , tsoc.nome AS status
                , IF(oc.parcelamento_id IS NOT NULL, 'parcelado', '') AS parcelamento
                , oc.parcelamento_id
            FROM operacao_contabil oc
                JOIN tipo_operacao_contabil toc ON toc.id = oc.tipo_operacao_contabil_id
                JOIN categoria_operacao_contabil coc ON coc.id = oc.categoria_operacao_contabil_id
                JOIN status_operacao_contabil soc ON soc.operacao_contabil_id = oc.id AND soc.data_fim IS NULL
                JOIN tipo_status_operacao_contabil tsoc ON tsoc.id = soc.tipo_status_operacao_contabil_id
        ";
    }
	
    public function listar($campo = NULL, $ordem = NULL)
    {
        if (isset($campo)) {
            $campo = ($campo = 'vencimento') ? 'venc_order' : $campo;
            $ordenacao = " ORDER BY {$campo} {$ordem}";
        } else {
            $ordenacao = ' ORDER BY tipo, categoria, venc_order';
        }

        $query = $this->db->query($this->sqlBase . $ordenacao);

        return $query->result();
    }

    public function inserir(array $dados, $idStatus)
    {
        $dados['vencimento'] = preg_replace($this->regexData, '\3-\2-\1', $dados['vencimento']);

        $valor = $dados['valor'];
        unset($dados['valor']);

        $this->db->trans_start();

        $this->db->insert('operacao_contabil', $dados);
        $id = $this->db->insert_id();
        $this->db->insert('status_operacao_contabil', array(
            'operacao_contabil_id'             => $id,
            'tipo_status_operacao_contabil_id' => $idStatus,
            'valor'                            => $valor,
            'data_inicio'					   => date('Y-m-d H:i:s')
        ));

        $this->db->trans_complete();
    }

    public function inserirParcelada(array $dados, $idStatus, $qtde)
    {
        $protocolo  = $dados['protocolo'];
        $vencimento = strtotime(preg_replace($this->regexData, '\3-\2-\1', $dados['vencimento']));
        $valor      = $dados['valor'];

        unset($dados['valor']);

        $this->db->trans_start();

        for ($i = 1; $i <= $qtde; $i++) {
            $parcela = $i - 1;
            $dados['protocolo']  = "$protocolo (Parcela ({$i}/{$qtde})";
            $dados['vencimento'] = date('Y-m-d', strtotime("+{$parcela} Month", $vencimento));
            $this->db->insert('operacao_contabil', $dados);
            if (!isset($id) || empty($id)) {
                $id = $this->db->insert_id();
                $dados['parcelamento_id'] = md5($id);
                $this->db->where('id', $id);
                $this->db->update('operacao_contabil', array('parcelamento_id' => $dados['parcelamento_id']));
            } else {
                $id = $this->db->insert_id();
            }
            $this->db->insert('status_operacao_contabil', array(
                'operacao_contabil_id'             => $id,
                'tipo_status_operacao_contabil_id' => $idStatus,
                'valor'                            => $valor,
                'data_inicio'					   => date('Y-m-d H:i:s')
            ));
        }

        $this->db->trans_complete();
    }

    public function atualizar(array $dados)
    {
        $id = $dados['id'];
        unset($dados['id']);

        $valor = $dados['valor'];
        unset($dados['valor']);

        $this->db->trans_start();

        $dados['vencimento'] = preg_replace($this->regexData, '\3-\2-\1', $dados['vencimento']);
        $this->db->where('id', $id);
        $this->db->update('operacao_contabil', $dados);

        $this->db->where('operacao_contabil_id', $id);
        $this->db->where('data_fim', NULL);
        $this->db->update('status_operacao_contabil', array('valor' => $valor));

        $this->db->trans_complete();
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
        $categoria  = "%{$dado}%";
        $status     = "%{$dado}%";

        $query = $this->db->query($this->sqlBase . '
            WHERE oc.vencimento = ?
                OR oc.protocolo like ?
                OR coc.nome like ?
                OR toc.nome like ?
                OR tsoc.nome like ?
            ORDER BY toc.nome
        ', array($vencimento, $valor, $protocolo, $categoria, $tipo, $status));

        return $query->result();
    }

    public function excluir($id)
    {
        $this->db->delete('operacao_contabil', array('id' => $id));
    }

    public function excluirTodasParcelas($id)
    {
        $operacaoContabil = $this->getById($id);

        $this->db->query("
            delete operacao_contabil, status_operacao_contabil
            from operacao_contabil, status_operacao_contabil
            where status_operacao_contabil.operacao_contabil_id = operacao_contabil.id
                and status_operacao_contabil.data_fim is null
                and status_operacao_contabil.tipo_status_operacao_contabil_id <> 2
                and operacao_contabil.parcelamento_id = ?
        ", array($operacaoContabil->parcelamento_id));
    }
}
?>
