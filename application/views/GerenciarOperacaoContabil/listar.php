<table class="layout-grid">
<tr><?php $this->titulos->render(); ?></tr>
<?php foreach ($operacoes as $key => $operacao): ?>
    <tr class="<?= ($key % 2) ? 'impar' : 'par';?>">
        <td nowrap><?= $operacao->tipo; ?></td>
        <td nowrap><?= $operacao->categoria; ?></td>
        <td align="right" nowrap><?php $valor = number_format($operacao->valor, 2, ',', '.'); echo $valor; ?></td>
        <td nowrap><?= $operacao->vencimento; ?></td>
        <td><?= $operacao->protocolo; ?>&nbsp;</td>
        <td nowrap><?= $operacao->status; ?></td>
        <td nowrap><?= $this->acoes->render("{$operacao->id}/{$operacao->tipo_operacao_contabil_id}", "{$operacao->tipo}\nCategoria: {$operacao->categoria}\nValor: {$valor}\nVencimento: {$operacao->vencimento}"); ?></td>
    </tr>
<?php endforeach; ?>
</table>
