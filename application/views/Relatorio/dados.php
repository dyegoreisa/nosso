<table class="layout-grid">
    <tr>
    <?php foreach ($campos as $campo): ?>
        <th><?= $campo->getLabel(); ?></th>
    <?php endforeach; ?>
    </tr>
<?php foreach ($contas as $key => $conta): ?>
<?php $corLinha = ($key % 2) ? 'impar' : 'par'; ?>
    <tr class="<?= $corLinha; ?>" operacaoContabilId="<?= $conta->id; ?>" tipoOperacaoContabilId="<?= $conta->tipo_operacao_contabil_id; ?>">
        <?php
        foreach ($campos as $campo) {
            $name = $campo->getName();
            if ($name == 'valor') {
                echo '<td align="right">' . number_format($conta->$name, 2, ',', '.') . '</td>';
            } else {
                if (!empty($atrasadas) && $name == 'vencimento' && isset($conta->atrasada) && $conta->atrasada == 'SIM') {
                    echo "<td style=\"color:red\">{$conta->$name}</td>";
                } else {
                    echo "<td>{$conta->$name}</td>";
                }
            }
        }
        ?>
    </tr>
<?php endforeach; ?>
</table>
<?= br(3); ?>
<table class="layout-grid-totais">
    <tr class="impar">
        <th>Total Recebido:</th>
        <td><?= number_format($total['recebido']->total, 2, ',', '.'); ?>
    </tr>
    <tr class="par">
        <th>Total Pago:</th>
        <td><?= number_format($total['pago']->total, 2, ',', '.'); ?></td>
    </tr>
    <tr class="impar">
        <th>Total A Pagar:</th>
        <td><?= number_format($total['a_pagar']->total, 2, ',', '.'); ?>
    </tr>
    <tr class="par">
        <th>Total Estimado:</th>
        <td><?= number_format($total['estimativa']->total, 2, ',', '.'); ?></td>
    </tr>
    <tr class="impar">
        <th>Total A pagar + Total Estimado:</th>
        <td><?= number_format($total['a_pagar']->total + $total['estimativa']->total, 2, ',', '.'); ?></td>
    </tr>
    <tr class="par">
        <?php $msgAtradasas = (empty($atrasadas)) ? '' : ' + contas atrasadas'; ?>
        <th>Total de contas no período<?= $msgAtradasas; ?>:</th>
        <td><?= number_format($total['pago']->total + $total['a_pagar']->total + $total['estimativa']->total, 2, ',', '.'); ?></td>
    </tr>
    <tr class="impar">
        <th>(Total A pagar + Total Estimado) - Total recebido:</th>
        <?php $valor = $total['recebido']->total - ($total['pago']->total + $total['a_pagar']->total + $total['estimativa']->total); ?>
        <td <?php if ($valor < 0): ?>style="color:red"<?php else: ?><?php endif; ?>><?= number_format($valor, 2, ',', '.'); ?></td>
    </tr>
</table>
