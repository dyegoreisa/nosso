<table class="layout-grid">
<tr><?php $this->titulos->render(); ?></tr>
<?php foreach ($operacoes as $key => $operacao): ?>
    <tr class="<?= ($key % 2) ? 'impar' : 'par';?>">
        <td nowrap><?= $operacao->tipo; ?></td>
        <td nowrap><?= $operacao->categoria; ?></td>
        <td><?= $operacao->protocolo; ?>&nbsp;</td>
        <td align="right" nowrap><?php $valor = number_format($operacao->valor, 2, ',', '.'); echo $valor; ?></td>
        <td nowrap><?= $operacao->vencimento; ?></td>
        <td nowrap><?= $operacao->status; ?></td>
        <td nowrap align="center"><?= $this->acoes->render("{$operacao->id}/{$operacao->tipo_operacao_contabil_id}", "{$operacao->tipo}\nCategoria: {$operacao->categoria}\nValor: {$valor}\nVencimento: {$operacao->vencimento}", $operacao->parcelamento); ?></td>
    </tr>
<?php endforeach; ?>
</table>
