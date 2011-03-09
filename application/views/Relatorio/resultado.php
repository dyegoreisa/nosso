<?php if (!empty($filtros)): ?>
<ul>
    <?php foreach ($filtros as $filtro): ?>
        <li><?= $filtro; ?></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
<table border="1" class="layout-grid">
    <tr>
        <th>Tipo</th>
		<th>Vencimento</th>
        <th>Valor</th>
        <th>Protocolo</th>
		<th>Status</th>
    </tr>
<?php foreach ($contas as $conta): ?>
    <tr>
        <td><?= $conta->nome; ?></td>
		<td><?= $conta->vencimento; ?></td>
        <td><?= $conta->valor; ?></td>
        <td><?= $conta->protocolo; ?></td>
		<td><?= $conta->status; ?></td>
    </tr>
<?php endforeach; ?>
</table>

