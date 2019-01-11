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

    if ($('#msg')) {
        //CKEDITOR.replace('msg');
        $('#msg').summernote({height: 300});
    }

});
