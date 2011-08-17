<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Receituario extends CI_Model
{ 
    private $regexData;
    private $columns;
    
    public function __construct()
    {
        parent::__construct();
        $this->regexData = '/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/([12][0-9]{3})$/';
        $this->columns = "
            r.id
            , r.pessoa_id
            , r.sintomas
            , r.data_sintoma
            , DATE_FORMAT(r.data_sintoma,'%d/%m/%Y') as data_sintomaBR
            , r.medicacao
            , r.data_melhora
            , DATE_FORMAT(r.data_melhora,'%d/%m/%Y') as data_melhoraBR
            , r.funcionou
            , if (r.funcionou = 1, 'Sim', 'Não') as funcionouBR
        ";
    }

    public function listar($campo = NULL, $ordem = NULL)
    {
        if (isset($campo)) {
            $this->db->order_by($campo, $ordem);
        } else {
            $this->db->order_by('data_sintoma');
        }
        
        $this->db->select($this->columns, FALSE);
        $query = $this->db->get('receituario r');

        return $query->result();
    }

    public function inserir(array $dados)
    {
        $dados['data_sintoma'] = preg_replace($this->regexData, '\3-\2-\1', $dados['data_sintoma']);
        if (isset($dados['data_melhora'])) {
            $dados['data_melhora'] = preg_replace($this->regexData, '\3-\2-\1', $dados['data_melhora']);
        }
        $this->db->insert('receituario', $dados);
        
        return $this->db->insert_id();
    }

    public function atualizar(array $dados)
    {
        $id = $dados['id'];
        unset($dados['id']);
        $dados['data_sintoma'] = preg_replace($this->regexData, '\3-\2-\1', $dados['data_sintoma']);
        if (isset($dados['data_melhora'])) {
            $dados['data_melhora'] = preg_replace($this->regexData, '\3-\2-\1', $dados['data_melhora']);
        }
        $this->db->where('id', $id);
        $this->db->update('receituario', $dados);
        return $id;
    }

    public function getById($id)
    {
        $query = $this->db->query("
            SELECT 
                {$this->columns}
            FROM receituario r
            WHERE r.id = ?
        ", array($id, $id));

        $receituario = $query->result();
        return $receituario[0];
    }

    public function buscar($dado)
    {
        $this->db->select($this->columns)->from('receituario')->or_like(array(
            'sintomas'    => $dado,
            'receituario' => $dado
        ));
        $query = $this->db->get();
        return $query->result();
    }

    public function excluir($id)
    {
        $this->db->delete('receituario', array('id' => $id));
    }

    public function getOptionsForDropdown()
    {
        $receituarios = array('' => '------');
        $result = $this->listar();
        foreach ($result as $receituario) {
            $receituarios[$receituario->id] = $receituario->nome;
        }
        return $receituarios;
    }
}
?>
