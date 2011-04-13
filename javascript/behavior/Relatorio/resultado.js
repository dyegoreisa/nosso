function modal(action, h, w) 
{
    var h = h;
    var w = w;
    $("#dialog-form").dialog({
        height: h,
        width: w,
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

function mudarTitulo(titulo)
{
    if ($('#ui-dialog-title-dialog-form').html() == null) {
        $('#dialog-form').attr('title', titulo);
    } else {
        $('#ui-dialog-title-dialog-form').html(titulo);
    }
}

$(document).ready(function() {
    $('.layout-grid tr').livequery('click', function() {
        var idOperacao     = $(this).attr('operacaoContabilId'); 
        var idTipoOperacao = $(this).attr('tipoOperacaoContabilId'); 

        mudarTitulo('Alterar status da conta');

        $('#dialog-form').load('/GerenciarOperacaoContabil/selecionarStatusAjax/' + idOperacao + '/' + idTipoOperacao);

        modal('/GerenciarOperacaoContabil/alterarStatusAjax', 255, 350);
    });
    
    $('#novo').click(function() {
        mudarTitulo('Cadastrar nova conta');

        $('#dialog-form').load('/GerenciarOperacaoContabil/editarAjax');

        modal('/GerenciarOperacaoContabil/salvarAjax', 340, 350);
    });
});
