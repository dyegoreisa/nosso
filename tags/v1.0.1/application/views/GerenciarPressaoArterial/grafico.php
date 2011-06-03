<script type="text/javascript" src="/javascript/swfobject/swfobject.js"></script>
<script type="text/javascript">
swfobject.embedSWF("/api/ofc/open-flash-chart.swf", "grafico_pa", "670", "400", "9.0.0", "expressInstall.swf", {
    "data-file":"/GerenciarPressaoArterial/dataJson/<?= $pessoa_id; ?>/<?= $data_inicio; ?>/<?= $data_fim; ?>"
} );
</script>
<div id="grafico_pa"> </div>
