<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/theme/redmond/jquery.ui.all.css" />
        <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/theme/style.css" />
        <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/theme/superfish.css" />
        <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/hoverIntent.js"></script>
        <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/superfish.js"></script>
        <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/supersubs.js"></script>
        <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/ui/jquery.ui.core.js"></script>
        <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/ui/jquery.ui.widget.js"></script>
        <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/ui/jquery.ui.button.js"></script>
        <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/ui/jquery.ui.datepicker.js"></script>
        <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/ui/i18n/jquery.ui.datepicker-pt-BR.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('a.excluir').click(function () {
                    descricao = $(this).attr('alt');
                    if (false == confirm('Deseja excluir este registro de ' +descricao+ '?')) {
                        return false;
                    }
                });

                $('a', '#submenu').button();
                $('input:submit', '#main').button();

                $("ul.sf-menu").supersubs({ 
                    minWidth:    12,
                    maxWidth:    27,
                    extraWidth:  1
                }).superfish();                

                $('input.data').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    showOtherMonths: true,
                    selectOtherMonths: true,
                    showButtonPanel: true,
                    showOn: "button",
                    buttonImage: "/theme/images/calendar.gif",
                    buttonImageOnly: true,
                    constrainInput: false
                });
            });
        </script>
        <title>Nosso Sistema</title>
    </head>
    <body>
        <p>Nosso Sistema</p>
        <div id="menu">
            <?php $this->menu->render(); ?>
        </div>
        <br/><br/><br/>
        <div id="main">
            <?php if (isset($template)): ?>
            <?php $dados = isset($dados) ? $dados : null; ?>
                <fieldset id="fieldset_main">
                    <legend><?= $titulo; ?></legend>
                    <div id="submenu">
                        <?php $this->submenu->render(); ?>
                    </div>
                    <?php $this->load->view($template, $dados); ?>
                </fieldset>
            <?php endif; ?>
        </div>
    </body>
</html>
