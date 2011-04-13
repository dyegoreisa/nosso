<fieldset>
    <legend>Metas</legend>
    <table class="layout-grid">
    <tr><?php $this->titulos->render(); ?></tr>
    <?php foreach ($metas as $key => $meta): ?>
        <tr class ="<?= ($key % 2) ? 'impar' : 'par'; ?>">
            <td nowrap><?= $meta->nome; ?></td>
            <td><?= $meta->dataBR; ?></td>
            <td align="right"><?= $meta->altura; ?></td>
            <td align="right"><?= $meta->peso; ?></td>
            <td align="center">[ a ] [ x ]</td>
        </tr>
    <?php endforeach; ?>
    </table>
</fieldset>
    <fieldset>
    <legend>Medidas</legend>
    <table class="layout-grid">
    <tr><?php $this->titulos->render(); ?></tr>
    <?php foreach ($medidas as $key => $medida): ?>
        <tr class ="<?= ($key % 2) ? 'impar' : 'par'; ?>">
            <td nowrap><?= $medida->nome; ?></td>
            <td><?= $medida->dataBR; ?></td>
            <td align="right"><?= $medida->altura; ?></td>
            <td align="right"><?= $medida->peso; ?></td>
            <td align="center"><?= $this->acoes->render($medida->id, $medida->nome); ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
</fieldset>
