<table border="1" class="layout-grid">
    <tr>
        <th>Tipo</th>
        <th>Categoria</th>
        <th>Valor</th>
        <th>Vencimento</th>
        <th>Protocolo</th>
        <th>Status</th>
        <th>A&ccedil;&otilde;es</th>
    </tr>
<?php foreach ($operacoes as $operacao): ?>
    <tr>
        <td><?= $operacao->tipo; ?></td>
        <td><?= $operacao->categoria; ?></td>
        <td align="right"><?php $valor = number_format($operacao->valor, 2, ',', '.'); echo $valor; ?></td>
        <td><?= $operacao->vencimento; ?></td>
        <td><?= $operacao->protocolo; ?>&nbsp;</td>
        <td><?= $operacao->status; ?></td>
        <td><?= $this->acoes->render($operacao->id, "conta à {$operacao->tipo} {$operacao->categoria} [{$valor}] [{$operacao->vencimento}]"); ?></td>
    </tr>
<?php endforeach; ?>
</table>
