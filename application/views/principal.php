<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/theme/south-street/jquery-ui-1.8.11.custom.css" />
        <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/theme/nosso.css" />
        <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/jquery-1.5.1.min.js"></script>
        <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/jquery-ui-1.8.11.custom.min.js"></script>
        <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/livequery/jquery.livequery.js"></script>
        <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/jquery.ui.datepicker-pt-BR.js"></script>
        <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/behavior/principal.js"></script>
        <?php if (isset($js) && $js === TRUE): ?>
            <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/behavior/<?= $template; ?>.js"></script>
        <?php endif; ?>
        <title>Nosso Sistema</title>
    </head>
    <body>

        <div id="wrapper">
            
            <div id="header"><h1>Nosso</h1></div>
            
            <div id="family"></div>
            
            <div id="head-top"></div>
            <div id="head-right"></div>
            
            <div id="nav">
                <?php $this->menu->render(); ?>
            </div>
            
            <div id="body"><div class="i">
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
                        <?php $this->load->view($template, $dados); ?>
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
                    <ul>
                        <li><a href="/GerenciarPressaoArterial/editar">Registrar pressão arterial</a></li>
                        <li><a href="/GerenciarMedida/editar">Registrar medida</a></li>
                    </ul>
                    </p>
                    
                    <div class="clear"></div>
                    
                    <h2><strong>Orçamento</strong></h2>
                    <p>
                    <ul>
                        <li><a href="/GerenciarOperacaoContabil/editar">Cadastrar nova conta</a></li>
                        <li><a href="/Relatorio/executar/<?=$dataInicio?>/<?=$dataFim?>">Emitir relatório de contas a pagar deste mês</a></li>
                        
                    </ul>
                    </p>
                    <!-- 
                    <h2 class="orange"><strong>Family</strong> fun &amp; travel</h2>
                    <div id="funtravel">
                        <img src="theme/images/pic_1.jpg" width="95" height="116" alt="Pic 1" class="left" />
                        <div id="collect">
                            <p class="dark">COLLECT OUR</p>
                            <p class="orange">FUN &amp; TRAVELBOOK</p>
                            <p class="other">Nulla turpis. Suspendisse erat ipsum, sodales dignissim, bibendum</p>
                        </div>
                    </div>
                    --!>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </body>
</html>
