$(function () {

    if (('#datatable_matmeds')) {
        dataTableImport = $('#datatable_matmeds').DataTable({
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
                "url": baseUrl + '/matmed/listar',
                "type": "POST",
                "data": function (d) {
                    return  $.extend(d, geral.serializeObject('form_listar_matmed'));
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
