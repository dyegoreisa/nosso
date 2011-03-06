<table border="1">
	<tr>
		<th>Nome</th>
		<th>Sobrenome</th>
		<th>Sexo</th>
	</tr>
<?php foreach ($pessoas as $pessoa): ?>
	<tr>
		<td><?= $pessoa->nome; ?></td>
		<td><?= $pessoa->sobrenome; ?></td>
		<td><?= $pessoa->sexo; ?></td>
	</tr>
<?php endforeach; ?>
</table>
