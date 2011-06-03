$(document).ready(function() {
    $("#parcelada").livequery('click', function() {
        if ($(this).attr('checked')) {
            $(this).after('<span id="fieldparcelas"><br/><label for="qtde_parcelas">Quantidade de parcelas: </label><br/><input type="text" id="qtde_parcelas" value="" name="qtde_parcelas"></span>');
        } else {
            $("#fieldparcelas").remove();
        }
    });
});
