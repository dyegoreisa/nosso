<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pessoa extends CI_Model
{ 
    public function __construct()
    {
        parent::__construct(); 
    }

    public function listar($campo = NULL, $ordem = NULL)
    {
        if (isset($campo)) {
            $this->db->order_by($campo, $ordem);
        } else {
            $this->db->order_by('nome');
        }

        $query = $this->db->get('pessoa');

        return $query->result();
    }

    public function inserir(array $dados)
    {
        $this->db->insert('pessoa', $dados);
        return $this->db->insert_id();
    }

    public function atualizar(array $dados)
    {
        $id = $dados['id'];
        unset($dados['id']);
        $this->db->where('id', $id);
        $this->db->update('pessoa', $dados);
        return $id;
    }

    public function getById($id)
    {
        $query = $this->db->query("
            SELECT 
                p.id
                , p.nome
                , p.sobrenome
                , p.sexo
                , p.tipo_osseo
                , p.imagem_id
                , m.peso
                , m.altura
            FROM pessoa p
                LEFT JOIN (SELECT 
                        m.pessoa_id
                        , m.altura
                        , m.peso 
                      FROM medida m 
                      WHERE pessoa_id = ?
                      ORDER BY id DESC 
                      LIMIT 1) m ON m.pessoa_id = p.id
            WHERE p.id = ?
        ", array($id, $id));

        $pessoa = $query->result();
        return $pessoa[0];
    }

    public function buscar($dado)
    {
        $this->db->select('*')->from('pessoa')->or_like(array(
            'nome'      => $dado,
            'sobrenome' => $dado,
            'sexo'      => $dado
        ));
        $query = $this->db->get();
        return $query->result();
    }

    public function excluir($id)
    {
        $this->db->delete('pessoa', array('id' => $id));
    }

    public function getOptionsForDropdown()
    {
        $pessoas = array('' => '------');
        $result = $this->listar();
        foreach ($result as $pessoa) {
            $pessoas[$pessoa->id] = $pessoa->nome;
        }
        return $pessoas;
    }

    public function getTipoOsseoById($id)
    {
        $pessoa = $this->getById($id);
        return $pessoa->tipo_osseo;
    }

    public function getImagemIdById($id)
    {
        $pessoa = $this->getById($id);
        return $pessoa->imagem_id;
    }
}
?>
