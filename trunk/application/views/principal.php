<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=latin1" />
    <title>Nosso Sistema</title>
</head>
<body>
	<p>Nosso Sistema</p>
	<?php $this->menu->render(); ?>
	<div id="main">
	<?php if(isset($template)): ?>
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
