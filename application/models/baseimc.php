<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BaseIMC extends CI_Model
{ 
    public function __construct()
    {
        parent::__construct(); 
    }

    private function getByParam($sexo, $tipoOsseo)
    {
        $this->db->select('bi.imc')
                 ->from('base_imc bi')
                 ->where('sexo', $sexo) 
                 ->where('tipo_osseo', $tipoOsseo)
                 ->limit(1);
        $query = $this->db->get();
        $baseImc = $query->result();
        if (empty($baseImc)) {
            return NULL;
        } else {
            return $baseImc[0]->imc;
        }
    }

    public function getPesoIdeal($sexo, $tipoOsseo, $altura)
    {
        $baseIMC = $this->getByParam($sexo, $tipoOsseo);
        $pesoIdeal = (float)$baseIMC * ($altura * $altura);
        return $pesoIdeal;
    }

    public function getIMCIdeal($sexo, $tipoOsseo)
    {
        $IMCIdeal = $this->getByParam($sexo, $tipoOsseo);
        return $IMCIdeal;
    }
}
?>
