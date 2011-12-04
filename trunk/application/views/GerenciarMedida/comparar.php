<div class="diferenca">
    <div class="antes">
        <h2>ANTES</h2>
        <p>Data: <?= $primeira->dataBR; ?></p>
        <p>Peso: <?= number_format($primeira->peso, 3); ?></p>
        <img src="/GerenciarImagem/mostrar/<?= $primeira->imagem_frente_id; ?>" height="400"/>
    </div>
    <div class="depois">
        <h2>DEPOIS</h2>
        <p>Data: <?= $segunda->dataBR; ?></p>
        <p>Peso: <?= number_format($segunda->peso, 3); ?></p>
        <img src="/GerenciarImagem/mostrar/<?= $segunda->imagem_frente_id; ?>" height="400"/>
    </div>
    <p>
        <? if ($diferenca < 0): ?>
            <p class="engordou"><?= $msg; ?></p>
        <? else: ?>
            <p class="emagreceu"><?= $msg; ?></p>
        <? endif; ?>
</div>
