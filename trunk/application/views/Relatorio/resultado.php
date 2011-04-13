<?php if (!empty($filtrosAjax)): ?>
<span id="filtros_ajax" style="display:none"><?= $filtrosAjax; ?></span>
<?php endif; ?>
<div id="dialog-form" title="BLANK" style="display:none"></div>
<?php if (!empty($displayFiltros)): ?>
<div class="filtros">
<ul>
    <?php foreach ($displayFiltros as $filtro): ?>
        <li><?= $filtro; ?></li>
    <?php endforeach; ?>
</ul>
</div>
<?php endif; ?>
<div class="botoes">
   <a href="#" id="novo">Novo</a> 
</div>
<?//=br(4); ?>
<div id="dados">
<?php include 'dados.php'; ?>
</div>
