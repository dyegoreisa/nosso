<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Imagem extends CI_Model
{ 
    public function __construct()
    {
        parent::__construct(); 
    }

    private function inserir(array $file)
    {
        $imagem = file_get_contents($file['tmp_name']);
        $dados = array(
            'imagem'    => $imagem,
            'mime_type' => $file['type']
        );
        $this->db->insert('imagem', $dados);
        return $this->db->insert_id();
    }

    private function atualizar($id, array $file)
    {
        
        $imagem = file_get_contents($file['tmp_name']);
        $this->db->where('id', $id);
        $this->db->update('imagem', array('imagem' => $imagem));
        return $id;
    }

    public function alterar(array $file, $id = NULL)
    {
        $imagem = $this->getById($id);
        if (isset($imagem->id)) {
            return $this->atualizar($imagem->id, $file);
        } else {
            return $this->inserir($file);
        }
    }

    public function excluir($id)
    {
        $this->db->delete('imagem', array('id' => $id));
    }

    public function getById($id)
    {
        $query = $this->db->query("
            SELECT 
                i.id
                , i.imagem
                , i.mime_type
                , i.data_atualizacao
            FROM imagem i
            WHERE i.id = ?
        ", array($id));

        $imagem = $query->result();
        return (!empty($imagem)) ? $imagem[0] : NULL;
    }
}
