<table class="layout-grid">
<tr><?php $this->titulos->render(); ?></tr>
<?php foreach ($pessoas as $key => $pessoa): ?>
    <tr class ="<?= ($key % 2) ? 'impar' : 'par'; ?>">
        <td nowrap><?= $pessoa->nome; ?></td>
        <td><?= $pessoa->sobrenome; ?></td>
        <td nowrap><?= $pessoa->sexo; ?></td>
        <td nowrap align="center"><?= $this->acoes->render($pessoa->id, $pessoa->nome); ?></td>
    </tr>
<?php endforeach; ?>
</table>
