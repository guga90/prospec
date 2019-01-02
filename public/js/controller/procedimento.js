$(function () {

    if (('#datatable_procedimentos')) {
        dataTableImport = $('#datatable_procedimentos').DataTable({
            "processing": true,
            "serverSide": true,
            "language": {
                "url": baseUrl + "/AdminLTE/bower_components/datatables.net-bs/js/Portuguese-Brasil.json"
            },
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true,
            "pageLength": 100,
            "ajax": {
                "url": baseUrl + '/procedimento/listar',
                "type": "POST",
                "data": function (d) {
                    return  $.extend(d, geral.serializeObject('form_listar_procedimento'));
                }
            },
            "columns": [
                {"data": "codigo"},
                {"data": "name"},
                {"data": "status"},
                {"data": "btn", "orderable": false}
            ],
            "order": [[0, "desc"]]
        });
    }
});
