<table class="layout-grid">
<tr><?php $this->titulos->render(); ?></tr>
<?php foreach ($pressaoArterials as $key => $pressaoArterial): ?>
    <tr class ="<?= ($key % 2) ? 'impar' : 'par'; ?>">
        <td nowrap><?= $pressaoArterial->nome; ?></td>
        <td nowrap><?= $pressaoArterial->data; ?></td>
        <td nowrap><?= $pressaoArterial->hora; ?></td>
        <td nowrap align="right"><?= $pressaoArterial->sistolica; ?></td>
        <td nowrap align="right"><?= $pressaoArterial->diastolica; ?></td>
        <td nowrap><?= $pressaoArterial->posicao; ?></td>
        <td><?= ($pressaoArterial->em_atividade == 1) ? 'Sim' : 'Não'; ?></td>
        <td nowrap><?= $this->acoes->render($pressaoArterial->id, $pressaoArterial->nome); ?></td>
    </tr>
<?php endforeach; ?>
</table>
