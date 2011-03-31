function modal(action) 
{
    $("#dialog-form").dialog({
        height: 400,
        width: 350,
        modal: true,
        buttons: {
            "Salvar": function() {
                $.post(action, $('.formulario').serialize(), function(data) {
                    carregarDados(data);
                });
            },
        },
    });
}

function carregarDados(data)
{
    if (data == 'ok') {
        var filtros = $("#filtros_ajax").html()
        $("#dados").load('/Relatorio/executarAjax/' + filtros);
        $("#dialog-form").dialog( "close" );
    } else {
        $("#dialog-form").html(data);
    }
}

$(document).ready(function() {
    $('.layout-grid tr').livequery('click', function() {
        var idOperacao     = $(this).attr('operacaoContabilId'); 
        var idTipoOperacao = $(this).attr('tipoOperacaoContabilId'); 
        $('#dialog-form').load('/GerenciarOperacaoContabil/selecionarStatusAjax/' + idOperacao + '/' + idTipoOperacao);
        modal('/GerenciarOperacaoContabil/alterarStatusAjax');
    });
    
    $('#novo').click(function() {
        $('#dialog-form').load('/GerenciarOperacaoContabil/editarAjax');
        modal('/GerenciarOperacaoContabil/salvarAjax');
    });
});
