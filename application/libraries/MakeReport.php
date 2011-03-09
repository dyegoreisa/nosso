<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MakeReport
{
    private $CI;
    private $filtros;
    private $displayFiltros;
    private $regexData;
    private $regexData2;

    public function __construct()
    {
        $this->regexData  = '/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/([12][0-9]{3})$/';
        $this->regexData2 = '/^([12][0-9]{3})-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/';
        $this->CI =& get_instance();
    }

    public function addFiltro($key, $val, $isData = FALSE)
    {
        if ($isData === TRUE) {
            $this->filtros[$key] = preg_replace($this->regexData, '\3-\2-\1', $val);
        } else {
            $this->filtros[$key] = $val;
        }
    }

    private function makeWhere()
    {
        $where = array();
        if (!empty($this->filtros['data_inicio'])) {
            $where[] = "oc.vencimento >= '{$this->filtros['data_inicio']}'";
            $this->displayFiltros[] = 'Data inicio: ' . preg_replace($this->regexData2, '\3/\2/\1', $this->filtros['data_inicio']);
        }

        if (!empty($this->filtros['data_fim'])) {
            $where[] = "oc.vencimento <= '{$this->filtros['data_fim']}'";
            $this->displayFiltros[] = 'Data fim: ' . preg_replace($this->regexData2, '\3/\2/\1', $this->filtros['data_fim']);
        }

        if ($this->filtros['tipo'] != 0) {
            $where[] = "toc.id = '{$this->filtros['tipo']}'";
			$query = $this->CI->db->get_where('tipo_operacao_contabil', array('id' => $this->filtros['tipo']));
			$tipo = $query->result();
            $this->displayFiltros[] = 'Tipo: ' . $tipo[0]->nome;
        }

        if ($this->filtros['status'] != 0) {
            $where[] = "tsoc.id = '{$this->filtros['status']}'";
			$query = $this->CI->db->get_where('tipo_status_operacao_contabil', array('id' => $this->filtros['status']));
			$status = $query->result();
            $this->displayFiltros[] = 'Status: ' . $status[0]->nome;
        }

        return empty($where) ? '' : 'WHERE ' . implode(' AND ', $where);
    }

    public function getDisplayFiltros()
    {
        return $this->displayFiltros;
    }

    public function process()
    {
        $query = $this->CI->db->query("
            SELECT
                oc.id
                , DATE_FORMAT(oc.vencimento, '%d/%m/%Y') as vencimento
                , FORMAT(oc.valor, 2) as valor
                , oc.protocolo
                , toc.nome
                , tsoc.nome as status
            FROM operacao_contabil oc
                JOIN tipo_operacao_contabil toc ON toc.id = oc.tipo_operacao_contabil_id
                JOIN status_operacao_contabil soc ON soc.operacao_contabil_id = oc.id AND soc.data_fim IS NULL
                JOIN tipo_status_operacao_contabil tsoc ON tsoc.id = soc.tipo_status_operacao_contabil_id
            {$this->makeWhere()}
            ORDER BY oc.vencimento
        ");

        return $query->result();
    }
}
?>
