$(document).ready(function() {
    $('a.excluir').click(function () {
        descricao = $(this).attr('alt');
        if (false == confirm('Deseja excluir este registro de ' +descricao+ '?')) {
            return false;
        }
    });

    $('input.data').datepicker({
        changeMonth: true,
        changeYear: true,
        showOtherMonths: true,
        selectOtherMonths: true,
        showButtonPanel: true,
        showOn: "button",
        buttonImage: "/theme/images/calendar.gif",
        buttonImageOnly: true,
        constrainInput: false
    });

    $(".menu_tabs").tabs({
        cookie: {
			expires: 1
		}
    });

    $('input:submit', '.form').button();
    $('a', '#submenu').button();
    //$('a', '#menu', 'li', '.botoes').button();
    $('a', '.botoes_principal').button();

    $('.botoes #novo').button({
        icons: {
            primary: "ui-icon-circle-plus"
        }
    });

    $('.novo').button({
        icons: {
            primary: "ui-icon-circle-plus"
        }
    });

    $('.buscar').button({
        icons: {
            primary: "ui-icon-search"
        }
    });

    $('.listar').button({
        icons: {
            primary: "ui-icon-newwin"
        }
    });

    $('.grafico').button({
        icons: {
            primary: "ui-icon-image"
        }
    });

    $('a.alterar').button({
        icons: {
            primary: "ui-icon-document"
        },
        text: false
    });

    $('a.status').button({
        icons: {
            primary: "ui-icon-flag"
        },
        text: false
    });

    $('a.excluir').button({
        icons: {
            primary: "ui-icon-trash"
        },
        text: false
    });
});
