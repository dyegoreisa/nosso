<table border="1" class="layout-grid">
    <tr>
        <th>Tipo</th>
        <th>Valor</th>
        <th>Vencimento</th>
        <th>Protocolo</th>
        <th>Status</th>
        <th>A&ccedil;&otilde;es</th>
    </tr>
<?php foreach ($operacoes as $operacao): ?>
    <tr>
        <td><?= $operacao->tipo; ?></td>
        <td><?= $operacao->valor; ?></td>
        <td><?= $operacao->vencimento; ?></td>
        <td><?= $operacao->protocolo; ?></td>
        <td><?= $operacao->status; ?></td>
        <td><?= $this->acoes->render($operacao->id, "{$operacao->tipo} [{$operacao->valor}] [{$operacao->vencimento}]"); ?></td>
    </tr>
<?php endforeach; ?>
</table>
