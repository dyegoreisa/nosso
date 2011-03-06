#!/bin/bash

CONTENT_A="<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class "
CONTENT_B=" extends CI_Controller 
{
    function __construct()
    {
        parent::__construct();
    }
}
?>
"

CONTROLLERS="cardapio medida operacao_contabil pessoa prato sessao status_operacao_contabil tipo_operacao_contabil tipo_status_operacao_contabil usuario"

for CONTROLLER in $CONTROLLERS
do
    touch $CONTROLLER.php
    CLASS=`echo $CONTROLLER | sed -e 's/_\([a-z]\)/\u\1/g' -e 's/^\([a-z]\)/\u\1/g'`
    echo $CONTENT_A$CLASS$CONTENT_B >> $CONTROLLER.php
done
