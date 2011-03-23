<table class="layout-grid">
<tr><?php $this->titulos->render(); ?></tr>
<?php foreach ($medidas as $key => $medida): ?>
    <tr class ="<?= ($key % 2) ? 'impar' : 'par'; ?>">
        <td nowrap><?= $medida->nome; ?></td>
        <td><?= $medida->data; ?></td>
        <td align="right"><?= $medida->altura; ?></td>
        <td align="right"><?= $medida->peso; ?></td>
        <td><?= $this->acoes->render($medida->id, $medida->nome); ?></td>
    </tr>
<?php endforeach; ?>
</table>
