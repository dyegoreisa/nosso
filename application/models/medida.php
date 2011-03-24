<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Medida extends CI_Model
{ 
    private $regexData;
    private $columns;

    public function __construct()
    {
        parent::__construct(); 
        $this->regexData = '/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/([12][0-9]{3})$/';
        $this->columns = "
            m.id
            , DATE_FORMAT(m.data,'%d/%m/%Y') as data
            , m.altura
            , m.peso
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

        $this->db->select($this->columns, FALSE)->from('medida m')->join('pessoa p', 'm.pessoa_id = p.id')->where('p.nome', 'dyego');
        $query = $this->db->get();

        return $query->result();
    }

    public function inserir(array $dados)
    {
        $dados['data'] = preg_replace($this->regexData, '\3-\2-\1', $dados['data']);
        $this->db->insert('medida', $dados);

        return $this->db->insert_id();
    }

    public function atualizar(array $dados)
    {
        $id = $dados['id'];
        unset($dados['id']);
        $dados['data'] = preg_replace($this->regexData, '\3-\2-\1', $dados['data']);
        $this->db->where('id', $id);
        $this->db->update('medida', $dados);
        
        return $id;
    }

    public function getById($id)
    {
        $query = $this->db->get_where('medida', array('id' => $id));
        $medida = $query->result();
        return $medida[0];
    }

    public function buscar($dado)
    {
        if (is_numeric($dado)) {
            $this->db->where('m.id', $dado);
        } else {
            $this->db->or_like(array(
                'p.nome'   => $dado,
                'm.data'   => preg_replace($this->regexData, '\3-\2-\1', $dado),
                'm.altura' => $dado,
                'm.peso'   => $dado
            ));
        }

        $this->db->select($this->columns, FALSE)->from('medida m')->join('pessoa p', 'm.pessoa_id = p.id');
        $query = $this->db->get();

        return $query->result();
    }

    public function excluir($id)
    {
        $this->db->delete('medida', array('id' => $id));
    }

    public function grafico($pessoaId, $dataInicio, $dataFim, $tipoDado)
    {   
        $this->db->select($this->columns, FALSE)
                 ->from('medida m')
                 ->join('pessoa p', 'm.pessoa_id = p.id')
                 ->where('p.id', $pessoaId)
                 ->where("m.data >= '{$dataInicio}'")
                 ->where("m.data <= '{$dataFim}'")
                 ->order_by('data');

        $query = $this->db->get();

        $result = $query->result();

        switch($tipoDado)
        {
            case 'peso':
                return $this->listaPesos($result);
                break;
        }
    }

    private function listaPesos($dados)
    {
        $array = array();
        foreach ($dados as $key => $dado) {
            $array['peso'][$key] = (float)$dado->peso;
            $array['data'][$key] = $dado->data;
        }

        return $array;
    }
}
?>
