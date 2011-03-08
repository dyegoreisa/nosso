<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/theme/default/css/style.css" />
        <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/jquery-1.5.1.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.excluir').click(function () {
                    if (false == confirm('Deseja excluir este registro?')) {
                        return false;
                    }
                });
            });
        </script>
        <title>Nosso Sistema</title>
    </head>
    <body>
        <p>Nosso Sistema</p>
        <?php $this->menu->render(); ?>
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
