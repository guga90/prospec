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
    initComboProcedimento();

    for (i in kitmatmeds) {
        adicionarMatmed(kitmatmeds[i]);
    }

});

function initComboProcedimento() {

    $('#id_procedimento').select2({
        placeholder: "Buscar",
        minimumInputLength: 3,
        ajax: {
            url: baseUrl + "/utility/listarprocedimentos/",
            dataType: 'json',
            quietMillis: 100,
            data: function (term, page) {
                return {
                    q: term, //search term
                    page_limit: 10, // page size
                    page: page
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            }
        },
        escapeMarkup: function (m) {
            return m;
        },
        cache: true
    });
}
function initComboMatmed() {

    $('.id_matmed').select2({
        placeholder: "Buscar",
        minimumInputLength: 3,
        ajax: {
            url: baseUrl + "/utility/listarmatmeds/",
            dataType: 'json',
            quietMillis: 100,
            data: function (term, page) {
                return {
                    q: term, //search term
                    page_limit: 10, // page size
                    page: page
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            }
        },
        escapeMarkup: function (m) {
            return m;
        },
        cache: true
    });
}

function adicionarMatmed(obj) {

    var html = '<div class="linha">' +
            '<div class="col-md-8">' +
            '<div class="form-group">' +
            '<label for="id_matmed">Matmed</label>' +
            '<select name="matmed[id_matmed][]" class="form-control select2 id_matmed" value="' + obj.id_matmed + '">';

    if (obj.id_matmed != '') {
        html += '<option value="' + obj.id_matmed + '" >' + obj.name_matmed + '</option>';
    }

    html += '</select>' +
            '</div>' +
            '</div>' +
            '<div class=" col-md-3">' +
            '<div class="form-group">' +
            '<label for="quantidade">Quantidade</label>' +
            '<input maxlength="100" required="true" type="text" name="matmed[quantidade][]" value="' + (obj == obj.quantidade ? '' : obj.quantidade) + '" class="form-control" placeholder="Quantidade">' +
            '</div>' +
            '</div>' +
            '<div class=" col-md-1">' +
            '<div class="form-group">' +
            '<button style="margin-top: 25px" class="btn btn-danger" onclick="removerMatmed(this)">Excluir</button>' +
            '</div>' +
            '</div>' +
            '</div>';

    $('#matmeds').append(html);

    initComboMatmed();

}

function validarForm() {
    
    if($('#matmeds').children().length == 0){
        geral.showMensagem({'tipo':'Alerta', 'msg' : 'Por favor acicione um matmed.'})
        return false;
    }
}

function removerMatmed(obj) {
    obj.parentNode.parentNode.parentNode.remove();
}
