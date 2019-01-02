$(function () {

    if ($('#datatable_default')) {
        $('#datatable_default').DataTable({
            "language": {
                "url": "AdminLTE/bower_components/datatables.net-bs/js/Portuguese-Brasil.json"
            },
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false
        });
    }
});

function searchAddress(zipCode) {

    geral.consultarEndCep(zipCode, function (response) {

        $('#address').val(response.tipo_logradouro + ' ' + response.logradouro);
        $('#sector').val(response.bairro);
        $('#city').val(response.cidade);
        $('#state').val(response.uf);

    });
}