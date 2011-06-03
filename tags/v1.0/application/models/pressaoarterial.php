<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PressaoArterial extends CI_Model
{ 
    private $regexData;
    private $columns;

    public function __construct()
    {
        parent::__construct(); 
        $this->regexData = '/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/([12][0-9]{3})$/';
        $this->columns = "
            pa.id
            , pa.data
            , DATE_FORMAT(pa.data, '%d/%m/%Y') as dataBR
            , pa.hora
            , pa.sistolica
            , pa.diastolica
            , pa.posicao
            , pa.em_atividade
            , p.nome
        ";
    }

    public function listar($campo = NULL, $ordem = NULL)
    {
        if (isset($campo)) {
            $this->db->order_by($campo, $ordem);
        } else {
            $this->db->order_by('data');
        }

        $this->db->select($this->columns, FALSE)->from('pressao_arterial pa')->join('pessoa p', 'pa.pessoa_id = p.id');
        $query = $this->db->get();

        return $query->result();
    }

    public function inserir(array $dados)
    {
        $dados['data'] = preg_replace($this->regexData, '\3-\2-\1', $dados['data']);
        $this->db->insert('pressao_arterial', $dados);

        return $this->db->insert_id();
    }

    public function atualizar(array $dados)
    {
        $id = $dados['id'];
        unset($dados['id']);
        $dados['data'] = preg_replace($this->regexData, '\3-\2-\1', $dados['data']);
        $this->db->where('id', $id);
        $this->db->update('pressao_arterial', $dados);
        
        return $id;
    }

    public function getById($id)
    {
        $query = $this->db->get_where('pressao_arterial', array('id' => $id));
        $pressao_arterial = $query->result();
        return $pressao_arterial[0];
    }

    public function buscar($dado)
    {
        if (is_numeric($dado)) {
            $this->db->where('pa.id', $dado);
        } else {
            $this->db->or_like(array(
                'p.nome'  => $dado,
                'pa.data' => preg_replace($this->regexData, '\3-\2-\1', $dado),
                'pa.hora' => $dado
            ));
        }

        $this->db->select($this->columns, FALSE)->from('pressao_arterial pa')->join('pessoa p', 'pa.pessoa_id = p.id');
        $query = $this->db->get();

        return $query->result();
    }

    public function excluir($id)
    {
        $this->db->delete('pressao_arterial', array('id' => $id));
    }

    public function grafico($pessoaId, $dataInicio, $dataFim, $tipoDado)
    {   
        $this->db->select($this->columns, FALSE)
                 ->from('pressao_arterial pa')
                 ->join('pessoa p', 'pa.pessoa_id = p.id')
                 ->where('p.id', $pessoaId)
                 ->where("pa.data >= '{$dataInicio}'")
                 ->where("pa.data <= '{$dataFim}'")
                 ->order_by('data', 'ASC');

        $query = $this->db->get();

        $result = $query->result();

        switch($tipoDado)
        {
            case 'pa':
                return $this->listaPA($result);
                break;
        }
    }

    private function listaPA($dados)
    {
        $array = array();
        foreach ($dados as $key => $dado) {
            $array['sistolica'][$key] = (float)$dado->sistolica;
            $array['diastolica'][$key] = (float)$dado->diastolica;
            $array['data'][$key] = $dado->dataBR;
        }

        return $array;
    }
}
?>
