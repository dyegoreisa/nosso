<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GerenciarImagem extends CI_Controller
{
    public function mostrar($imagemId)
    {
        $this->load->model('Imagem');
        $imagem = $this->Imagem->getById($imagemId);
        header("Content-type: {$imagem->mime_type}");
        echo $imagem->imagem;
    }
}
