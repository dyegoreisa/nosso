<table border="1" class="layout-grid">
    <tr>
        <th>Nome</th>
        <th>Sobrenome</th>
        <th>Sexo</th>
        <th>A&ccedil;&otilde;es</th>
    </tr>
<?php foreach ($pessoas as $pessoa): ?>
    <tr>
        <td><?= $pessoa->nome; ?></td>
        <td><?= $pessoa->sobrenome; ?></td>
        <td><?= $pessoa->sexo; ?></td>
        <td><?= $this->acoes->render($pessoa->id, $pessoa->nome); ?></td>
    </tr>
<?php endforeach; ?>
</table>
