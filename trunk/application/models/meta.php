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
            me.id
            , me.data
            , DATE_FORMAT(me.data,'%d/%m/%Y') as dataBR
            , me.altura
            , me.peso
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

        $this->db->select($this->columns, FALSE)->from('meta me')->join('pessoa p', 'me.pessoa_id = p.id')->where('p.nome', 'dyego');
        $query = $this->db->get();

        return $query->result();
    }

    public function inserir(array $dados, $pessoaId)
    {
        $dados['data'] = preg_replace($this->regexData, '\3-\2-\1', $dados['data']);

        $this->db->trans_start();

        $this->db->delete('meta', array('pessoa_id' => $pessoaId));
        $this->db->insert('meta', $dados);

        $this->db->trans_complete();

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
            $this->db->where('me.id', $dado);
        } else {
            $this->db->or_like(array(
                'p.nome'   => $dado,
                'me.data'   => preg_replace($this->regexData, '\3-\2-\1', $dado),
                'me.altura' => $dado,
                'me.peso'   => $dado
            ));
        }

        $this->db->select($this->columns, FALSE)->from('meta me')->join('pessoa p', 'me.pessoa_id = p.id');
        $query = $this->db->get();

        return $query->result();
    }

    public function excluir($id)
    {
        $this->db->delete('meta', array('id' => $id));
    }

    public function getByPessoaId($pessoaId)
    {
        $this->db->select($this->columns, FALSE)
                 ->from('meta me')
                 ->join('pessoa p', 'me.pessoa_id = p.id')
                 ->where('me.pessoa_id', $pessoaId)
                 ->order_by('data', 'desc')
                 ->limit(1);
        $query = $this->db->get();
        $meta = $query->result();
        if (empty($meta)) {
            return NULL;
        } else {
            return $meta[0];
        }
    }

    public function grafico($pessoaId)
    {   
        $this->db->select($this->columns, FALSE)
                 ->from('meta me')
                 ->join('pessoa p', 'me.pessoa_id = p.id')
                 ->where('p.id', $pessoaId)
                 ->order_by('data', 'DESC')
                 ->limit(1);

        $query = $this->db->get();

        $rowsMeta = $query->result();

        $this->db->select($this->columns, FALSE)
                 ->from('medida me')
                 ->join('pessoa p', 'me.pessoa_id = p.id')
                 ->where('p.id', $pessoaId)
                 ->order_by('data', 'ASC');

        $query = $this->db->get();

        $rowsMedida = $query->result();

        foreach ($rowsMedida as $key => $row) {
            $dados['medida']['peso'][$key] = (float)$row->peso;
            $dados['medida']['data'][$key] = $row->dataBR;
        }

        $dados['meta']['peso'][0] = (float)$rowsMedida[0]->peso;
        $dados['meta']['data'][0] = $rowsMedida[0]->dataBR;

        $dados['meta']['peso'][count($rowsMedida)-1] = (float)$rowsMeta[0]->peso;
        $dados['meta']['data'][count($rowsMedida)-1] = $rowsMeta[0]->dataBR;


        return $dados;
    }
}
?>
