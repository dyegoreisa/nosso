<?php if (!empty($filtros)): ?>
<ul>
    <?php foreach ($filtros as $filtro): ?>
        <li><?= $filtro; ?></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
<table class="layout-grid">
    <tr>
    <?php foreach ($campos as $campo): ?>
        <th><?= $campo->getLabel(); ?></th>
    <?php endforeach; ?>
    </tr>
<?php foreach ($contas as $key => $conta): ?>
<?php $corLinha = ($key % 2) ? 'impar' : 'par'; ?>
    <tr class="<?= $corLinha; ?>">
        <?php
        foreach ($campos as $campo) {
            $name = $campo->getName();
            echo "<td>{$conta->$name}</td>";
        }
        ?>
    </tr>
<?php endforeach; ?>
</table>
<?= br(3); ?>
<table class="layout-grid-totais">
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
        <th>Total de contas no período:</th>
        <td><?= number_format($total['pago']->total + $total['a_pagar']->total + $total['estimativa']->total, 2, ',', '.'); ?></td>
    </tr>
</table>

