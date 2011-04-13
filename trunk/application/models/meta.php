<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Meta extends CI_Model
{ 
    private $regexData;
    private $columns;

    public function __construct()
    {
        parent::__construct(); 
        $this->regexData = '/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/([12][0-9]{3})$/';
        $this->columns = "
            m.id
            , m.data
            , DATE_FORMAT(m.data,'%d/%m/%Y') as dataBR
            , m.peso / (m.altura * m.altura) as imc
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

        $this->db->select($this->columns, FALSE)->from('meta m')->join('pessoa p', 'm.pessoa_id = p.id')->where('p.nome', 'dyego');
        $query = $this->db->get();

        return $query->result();
    }

    public function inserir(array $dados)
    {
        $dados['data'] = preg_replace($this->regexData, '\3-\2-\1', $dados['data']);
        $this->db->insert('meta', $dados);

        return $this->db->insert_id();
    }

    public function atualizar(array $dados)
    {
        $id = $dados['id'];
        unset($dados['id']);
        $dados['data'] = preg_replace($this->regexData, '\3-\2-\1', $dados['data']);
        $this->db->where('id', $id);
        $this->db->update('meta', $dados);
        
        return $id;
    }

    public function getById($id)
    {
        $query = $this->db->get_where('meta', array('id' => $id));
        $meta = $query->result();
        return $meta[0];
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

        $this->db->select($this->columns, FALSE)->from('meta m')->join('pessoa p', 'm.pessoa_id = p.id');
        $query = $this->db->get();

        return $query->result();
    }

    public function excluir($id)
    {
        $this->db->delete('meta', array('id' => $id));
    }

    public function getAlturaById($pessoaId)
    {
        $this->db->select('altura')
                 ->from('meta m')
                 ->where('m.pessoa_id', $pessoaId)
                 ->order_by('data', 'desc')
                 ->limit(1);
        $query = $this->db->get();
        $meta = $query->result();
        return (float)$meta[0]->altura;
    }
}
?>
