<table class="layout-grid">
<tr><?php $this->titulos->render(); ?></tr>
<?php foreach ($receituarios as $key => $receituario): ?>
    <tr class ="<?= ($key % 2) ? 'impar' : 'par'; ?>">
        <td><?= $receituario->sintomas; ?></td>
        <td><?= $receituario->data_sintomaBR; ?></td>
        <td><?= $receituario->funcionouBR; ?></td>
        <td nowrap align="center"><?= $this->acoes->render($receituario->id); ?></td>
    </tr>
<?php endforeach; ?>
</table>
