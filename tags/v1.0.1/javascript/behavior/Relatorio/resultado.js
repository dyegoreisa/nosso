function modal(action, h, w) 
{
    var h = h;
    var w = w;
    $("#dialog").dialog({
        height: h,
        width: w,
        modal: true,
        buttons: {
            "Salvar": function() {
                $.post(action, $('.formulario').serialize(), function(data) {
                    carregarDados(data);
                });
            }
        }
    });
}

function carregarDados(data, dataExtra)
{
    if (data == 'ok') {
        var filtros = $("#filtros_ajax").html()
        $("#dados").load('/Relatorio/executarAjax/' + filtros + '/' + dataExtra);
        $("#dialog").dialog( "close" );
    } else {
        $("#dialog").html(data);
    }
}

function mudarTitulo(titulo)
{
    if ($('#ui-dialog-title-dialog').html() == null) {
        $('#dialog').attr('title', titulo);
    } else {
        $('#ui-dialog-title-dialog').html(titulo);
    }
}

$(document).ready(function() {
    $('.layout-grid tr').livequery('click', function() {
        var idOperacao     = $(this).attr('operacaoContabilId'); 
        var idTipoOperacao = $(this).attr('tipoOperacaoContabilId'); 

        mudarTitulo('Alterar status da conta');

        $('#dialog').load('/GerenciarOperacaoContabil/selecionarStatusAjax/' + idOperacao + '/' + idTipoOperacao);

        modal('/GerenciarOperacaoContabil/alterarStatusAjax', 255, 350);
    });
    
    $('#novo').click(function() {
        mudarTitulo('Cadastrar nova conta');

        $('#dialog').load('/GerenciarOperacaoContabil/editarAjax');

        modal('/GerenciarOperacaoContabil/salvarAjax', 340, 350);
    });

    $('#mostrar_atrasadas').click(function() {
        var checked = $(this).attr('checked');
        carregarDados('ok', checked);
    });
});
