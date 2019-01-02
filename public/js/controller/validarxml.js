$(function () {
    $(".lined").linedtextarea({
        selectedLine: linhas,
        selectedClass: 'lineselect'
    });

});

function validarXml() {

    $('#form_validadorxml').attr('action', baseUrl + '/validarxml');
    $('#form_validadorxml').submit();

}

function baixarXML() {

    if ($('#xml').val() != '') {
        $('#form_validadorxml').attr('action', baseUrl + '/validarxml/baixarxml');
        $('#form_validadorxml').submit();
    }

}

function baixarZIP() {
    
    if ($('#xml').val() != '') {
        $('#form_validadorxml').attr('action', baseUrl + '/validarxml/baixarzip');
        $('#form_validadorxml').submit();
    }

}
