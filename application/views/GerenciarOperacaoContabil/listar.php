<table border="1" class="layout-grid">
    <tr>
        <th>Tipo</th>
        <th>Valor</th>
        <th>Protocolo</th>
        <th>A&ccedil;&otilde;es</th>
    </tr>
<?php foreach ($operacoes as $operacao): ?>
    <tr>
        <td><?= $operacao->tipo_operacao_contabil; ?></td>
        <td><?= $operacao->valor; ?></td>
        <td><?= $operacao->protocolo; ?></td>
        <td><?= $this->acoes->render($operacao->id, "{$operacao->valor} [{$operacao->protocolo}]"); ?></td>
    </tr>
<?php endforeach; ?>
</table>
