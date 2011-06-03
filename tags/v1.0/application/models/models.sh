#!/bin/bash

CONTENT_A="<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class "
CONTENT_B=" extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
    }
}
?>
"

MODELS="cardapio medida operacao_contabil pessoa prato sessao status_operacao_contabil tipo_operacao_contabil tipo_status_operacao_contabil usuario"

for MODEL in $MODELS
do
    touch $MODEL.php
    CLASS=`echo $MODEL | sed -e 's/_\([a-z]\)/\u\1/g' -e 's/^\([a-z]\)/\u\1/g'`
    echo $CONTENT_A$CLASS$CONTENT_B >> $MODEL.php
done
