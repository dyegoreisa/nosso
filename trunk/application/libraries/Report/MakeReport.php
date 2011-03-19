<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/libraries/Report/Field.php';

class MakeReport
{
    private $CI;
    private $filtros;
    private $displayFiltros;
    private $regexData;
    private $regexData2;

    private $fields;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->regexData  = '/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/([12][0-9]{3})$/';
        $this->regexData2 = '/^([12][0-9]{3})-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/';
    }

    public function getFields()
    {  
        return $this->fields;
    }

    private function getCamposBase()
    {
        $campos = array();
        foreach ($this->fields as $field) {
            $campos[] = $field->getAliasDB();
        }
        return implode(', ', $campos);
    }

    private function getFrom()
    {
        return "
            FROM operacao_contabil oc
                JOIN tipo_operacao_contabil toc ON toc.id = oc.tipo_operacao_contabil_id
                JOIN categoria_operacao_contabil coc ON coc.id = oc.categoria_operacao_contabil_id
                JOIN status_operacao_contabil soc ON soc.operacao_contabil_id = oc.id AND soc.data_fim IS NULL
                JOIN tipo_status_operacao_contabil tsoc ON tsoc.id = soc.tipo_status_operacao_contabil_id
        ";
    }

    private function getOrder()
    {
        $ordem = array();
        foreach ($this->fields as $field) {
            if ($field->getAliasOrder() !== NULL) {
                $ordem[] = $field->getAliasOrder();
            }
        }
        return 'ORDER BY ' . implode(', ', $ordem);
    }

    public function getDisplayFiltros()
    {
        return $this->displayFiltros;
    }

    public function getTotais()
    {
        $totais['recebido']   = $this->process('recebido');
        $totais['pago']       = $this->process('pago');
        $totais['a_pagar']    = $this->process('a_pagar');
        $totais['estimativa'] = $this->process('estimativa');

        return $totais;
    }

    public function getContas()
    {
        return $this->process('contas');
    }

    public function addFiltro($key, $val, $isData = FALSE)
    {
        if ($isData === TRUE) {
            $this->filtros[$key] = preg_replace($this->regexData, '\3-\2-\1', $val);
        } else {
            $this->filtros[$key] = $val;
        }
    }

    public function addField($name, $label, $aliasDB, $aliasOrder)
    {
        $this->fields[] = new Field($name, $label, $aliasDB, $aliasOrder);
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

        if ($this->filtros['categoria'] != 0) {
            $where[] = "coc.id = '{$this->filtros['categoria']}'";
			$query = $this->CI->db->get_where('categoria_operacao_contabil', array('id' => $this->filtros['categoria']));
			$tipo = $query->result();
            $this->displayFiltros[] = 'Categoria: ' . $tipo[0]->nome;
        }

        if ($this->filtros['status'] != 0) {
            $where[] = "tsoc.id = '{$this->filtros['status']}'";
			$query = $this->CI->db->get_where('tipo_status_operacao_contabil', array('id' => $this->filtros['status']));
			$status = $query->result();
            $this->displayFiltros[] = 'Status: ' . $status[0]->nome;
        }

        //$where[] = "toc.nome = 'Saída'";

        return empty($where) ? '' : 'WHERE ' . implode(' AND ', $where);
    }

    private function execute($sql, $single = FALSE)
    {
        $query = $this->CI->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result();
            if ($single === TRUE) {
                return $result[0];
            } else {
                return $result;
            }
        } else {
            return NULL;
        }
    }

    private function process($tipoRelatorio)
    {
        switch($tipoRelatorio)
        {
            case 'contas':
                $sql = 'SELECT oc.id, ' . 
                       $this->getCamposBase() . 
                       $this->getFrom() . 
                       $this->makeWhere() . 
                       $this->getOrder();

                $result = $this->execute($sql);
                $result = isset($result) ? $result : array();
                break;

            case 'recebido':
                $sql = 'SELECT sum(soc.valor) as total' . 
                       $this->getFrom() . 
                       $this->makeWhere() . 
                       "AND tsoc.nome = 'Recebido'";

                $result = $this->execute($sql, TRUE);
                if (!isset($result->total)) {
                    $result->total = 0;
                }
                break;

            case 'pago':
                $sql = 'SELECT sum(soc.valor) as total' . 
                       $this->getFrom() . 
                       $this->makeWhere() . 
                       "AND tsoc.nome = 'Pago'";

                $result = $this->execute($sql, TRUE);
                if (!isset($result->total)) {
                    $result->total = 0;
                }
                break;

            case 'a_pagar':
                $sql = 'SELECT sum(soc.valor) as total' . 
                       $this->getFrom() . 
                       $this->makeWhere() . 
                       "AND tsoc.nome = 'A pagar'";

                $result = $this->execute($sql, TRUE);
                if (!isset($result->total)) {
                    $result->total = 0;
                }
                break;

            case 'estimativa':
                $sql = 'SELECT sum(soc.valor) as total' . 
                       $this->getFrom() . 
                       $this->makeWhere() . 
                       "AND tsoc.nome = 'Estimativa'";

                $result = $this->execute($sql, TRUE);
                if (!isset($result->total)) {
                    $result->total = 0;
                }
                break;
        }

        return $result;
    }
}
?>
