$(document).ready(function() {
    $('.comparar').click(function () {
        if ($('.form input:checked').length != 2) {
            alert("Para fazer a comparação selecione somente 2 (duas) medidas.");
            return false;
        }
    });
});