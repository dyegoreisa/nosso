<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <?php require_once 'head.php'?>
        <title>Nosso Sistema</title>
    </head>
    <body>

        <div id="wrapper">
            
            <div id="header"><a href="/principal"><h1>Nosso</h1></a></div>
            
            <div id="family"></div>
            
            <div id="head-top"></div>
            <div id="head-right"></div>
            
            <div id="nav">
                <ul></ul>
            </div>

            <div id="body"><div class="i">
                <div id="menu">
                    <?php $this->menu->render('tabs', 'menu_tabs'); ?>
                </div>
                <?php if (isset($template)): ?>
                    <h2 class="shallow"><strong><?= $titulo; ?></strong></h2>
                    <br/>
                    <p>
                    <?php $dados = isset($dados) ? $dados : null; ?>
                    <div id="submenu">
                        <?php $this->submenu->render(); ?>
                    </div>
                    <br/>
                    <fieldset id="fieldset_main">
                        <?php 
                            if ($template == 'form') {
                                $id       = (isset($dados['id']))    ? $dados['id']    : FALSE;
                                $multpart = (isset($dados['file']))  ? TRUE            : FALSE;
                                $class    = (isset($dados['class'])) ? $dados['class'] : FALSE;
                                $this->basicform->render($dados['action'], $dados['submit'], $class, $id, $multpart);
                            } else {
                                $this->load->view($template, $dados); 
                            }?>
                    </fieldset>
                    </p>
                <?php else: ?>
                    <h2 class="shallow"><strong>Bem-vindo</strong> ao sistema de multiferramentas</h2>
                    <p>Imaginem a vida como um jogo, no qual vocês fazem malabarismo com cinco bolas que lançam ao ar.
                    Essas bolas são: o trabalho, a família, a saúde, os amigos e o espírito.
                    O trabalho é uma bola de borracha. Se cair, bate no chão e pula para cima.
                    Más as quatro outras são de vidro. Se caírem no chão, quebrarão e ficarão permanentemente danificadas.
                    Entendam isto e busquem equilíbrio na vida.</p>

                    <p>Lembre-se: Ontem é história. Amanhã é mistério e hoje é uma dádiva. Por isso se chama “presente”.</p>
                    
                    <h2 class="shallow"><strong>Saúde</strong></h2>
                    <p>
                    <ul class="special">
                        <li><a href="/GerenciarPressaoArterial/editar">Registrar pressão arterial</a></li>
                        <li><a href="/GerenciarMedida/editar">Registrar medida</a></li>
                    </ul>
                    </p>
                    
                    <div class="clear"></div>
                    
                    <h2><strong>Orçamento</strong></h2>
                    <p>
                    <ul class="special">
                        <li><a href="/GerenciarOperacaoContabil/editar">Cadastrar nova conta</a></li>
                        <li><a href="/Relatorio/executar/<?=$dataInicio?>/<?=$dataFim?>">Emitir relatório de contas a pagar deste mês</a></li>
                        
                    </ul>
                    </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div id="dialog" title="BLANK" style="display:none"></div>
    </body>
</html>
