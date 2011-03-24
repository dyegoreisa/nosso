<script type="text/javascript" src="/javascript/swfobject/swfobject.js"></script>
<script type="text/javascript">
swfobject.embedSWF("/api/ofc/open-flash-chart.swf", "grafico_medida", "670", "400", "9.0.0", "expressInstall.swf", {
    "data-file":"/GerenciarMedida/dataJson/<?= $pessoa_id; ?>/<?= $data_inicio; ?>/<?= $data_fim; ?>"
} );
</script>
<div id="grafico_medida"> </div>
