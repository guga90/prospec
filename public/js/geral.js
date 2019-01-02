//Instancia da classe 
var geral = new Geral();

/*
 * Executa apos carregar a pagina
 */
$(document).ready(function () {

    geral.init();

    $.validator.setDefaults({
        debug: true,
        success: "valid"
    });

});

/*
 * Classe geral
 */
function Geral() {

    //Flaga para ignorar a loading
    this.ignoreLoading = false;

    this.init = function () {

        geral.maskForm();

        /*
         * Loading Ajax
         */
        $('body').on({
            ajaxStart: function ()
            {
                geral.loading(true);
            },
            ajaxStop: function ()
            {
                geral.loading(false);
            }
        });

        jQuery.validator.addMethod("needsSelection", function (value, element) {
            return $(element).multiselect("getChecked").length > 0;
        },
                "Por favor selecione um valor."
                );
        /*
         * Adiciona validador de data no jquery validate
         */
        jQuery.validator.addMethod("verificaHora", function (value, element) {
            return this.optional(element) || /^([01][0-9])|(2[0123]):([0-5])([0-9])$/.test(value);
        }, "Hora inválida."
                );

        /*
         * Adiciona validador de cnpj no jquery validate
         */
        jQuery.validator.addMethod("verificaCNPJ", function (value, element) {
            cnpj = value.replace(/\D/g, "");
            while (cnpj.length < 14)
                cnpj = "0" + cnpj;
            var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
            var a = [];
            var b = new Number;
            var c = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

            for (i = 0; i < 12; i++) {
                a[i] = cnpj.charAt(i);
                b += a[i] * c[i + 1];
            }

            if ((x = b % 11) < 2) {
                a[12] = 0
            } else {
                a[12] = 11 - x
            }
            b = 0;
            for (y = 0; y < 13; y++) {
                b += (a[y] * c[y]);
            }

            if ((x = b % 11) < 2) {
                a[13] = 0;
            } else {
                a[13] = 11 - x;
            }
            if ((cnpj.charAt(12) != a[12]) || (cnpj.charAt(13) != a[13]) || cnpj.match(expReg))
                if ($(element).val().length == 0)
                    return true;
                else
                    return false;
            return true;
        }, "CNPJ inválido."); // Mensagem padrao

        /*
         * Adiciona validador de cpf no jquery validate
         */
        jQuery.validator.addMethod("verificaCPF", function (value, element) {
            value = value.replace('.', '');
            value = value.replace('.', '');
            cpf = value.replace('-', '');
            while (cpf.length < 11)
                cpf = "0" + cpf;
            var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
            var a = [];
            var b = new Number;
            var c = 11;
            for (i = 0; i < 11; i++) {
                a[i] = cpf.charAt(i);
                if (i < 9)
                    b += (a[i] * --c);
            }
            if ((x = b % 11) < 2) {
                a[9] = 0
            } else {
                a[9] = 11 - x
            }
            b = 0;
            c = 11;
            for (y = 0; y < 10; y++)
                b += (a[y] * c--);
            if ((x = b % 11) < 2) {
                a[10] = 0;
            } else {
                a[10] = 11 - x;
            }
            if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg))
                return false;
            return true;
        }, "CPF inválido."); // Mensagem padrão
    };

    /**
     * Loading do sistema
     */
    this.loading = function (status)
    {
        if (status && !geral.ignoreLoading) {
            $('body').addClass('loading');
        } else {
            $('body').removeClass('loading');
        }
    };

    this.maskForm = function () {

        $('.mask_money').maskMoney({
            symbol: 'R$ ',
            thousands: '.',
            decimal: ',',
            symbolStay: true
        });

        $(".mask_cellphone").mask("(99) 99999-9999");

        $(".mask_homephone").mask("(99) 9999-9999");

        $('.mask_date').mask('99/99/9999');

        $('.mask_cpf').mask('999.999.999-99');

        $('.mask_cep').mask('99999-999');

        $(".mask_cnpj").mask("99.999.999/9999-99");
        
        $(".mask_placa").mask("AAA-9999");
        
        //$(".mask_number").mask("999.999");

    };


    /**
     * Funcao para submeter o formulario
     */
    this.submitForm = function (form, callback) {

        //Verifica se o formulário é válido
        if ($("form").valid()) {

            $.post(
                    form.action,
                    geral.serializeAll(form.id),
                    //$(form).serialize(),                
                            function (response)
                            {
                                //Caso tenha 
                                if (response[0].callback) {
                                    eval(response[0].callback);
                                }

                                //Executa a função enviada de callback
                                eval(callback);

                                if (response[0].tipo == 'Sucesso') {
                                    //Baixa a dialog do formulário            
                                    $('#dialog-form').dialog('close');
                                }

                                if (response[0].msg) {
                                    //Da show na mensagem
                                    geral.showMensagem(response[0]);
                                }

                                if (response[0].retorno_impressora &&
                                        (typeof response[0].retorno_impressora === 'object')) {

                                    geral.socket(response[0].retorno_impressora.disp_end,
                                            response[0].retorno_impressora.disp_porta,
                                            response[0].retorno_impressora.disp_pdf);

                                }

                                if (response[0].retorno_cancela &&
                                        (typeof response[0].retorno_cancela === 'object')) {

                                    geral.acionarCancela(response[0].retorno_cancela.disp_end, response[0].retorno_cancela.disp_porta);

                                }

                                if (response[0].retorno_cancela_ativar != null) {
                                    var cancelas = response[0].retorno_cancela_ativar;
                                    for (i in cancelas) {
                                        geral.ativarCancela(cancelas[i].disp_end, 1);
                                    }
                                }

                                if (response[0].retorno_cancela_desativar != null) {
                                    var cancelas = response[0].retorno_cancela_desativar;
                                    for (i in cancelas) {
                                        geral.ativarCancela(cancelas[i].disp_end, 0);
                                    }
                                }

                            },
                            'json'
                            );
                }
        return false;
    };

    /*
     * Função para exibir alerta(mensagem)
     */
    this.showMensagem = function (object) {

        $('#modal-title-alert').text(object.tipo);
        $('#modal-body-alert').text(object.msg);
        $('#modal-alert').modal('show');
    };
    
    /*
     * Função para exibir alerta(mensagem)
     */
    this.showMensagemConfirm = function (object) {

        $('#modal-title-alert-confirm').text(object.tipo);
        $('#modal-body-alert-confirm').text(object.msg);
        $('#modal-btnsim-alert-confirm').on('click', object.call);        
        $('#modal-alert-confirm').modal('show');
        
    };

    /*
     * Função para exibir alerta(mensagem)
     */
    this.limparForm = function () {

        //Varre todos os campos input
        $('form input, form select, form checkbox, form textarea').each(
                function (index, node) {

                    if (!node.disabled && node.type != 'hidden') {
                        //Limpa todos elementos
                        $('#' + node.id).val('');
                    }

                });

        //Limpa a multiselect
        $(".multiselect").multiselect('refresh');
    };

    /*
     * Função para exibir alerta(mensagem)
     */
    this.fechaForm = function () {

        //Baixa a dialog do formulário            
        $('#dialog-form').dialog('close');
    };

    /**
     * Popula a filtering select
     */
    this.populaFiltering = function (id_popula, url_popula, objData, objCampo, valor) {

        //Popula a grid de paramclientes
        $.ajax({
            type: "POST",
            url: url_popula,
            dataType: "json",
            data: objData,
            success: function (object) {

                //Remove os elementos atuais
                $('#' + id_popula).children().remove();

                if (objCampo.value != '') {

                    //Habilita o campo a ser populado
                    $('#' + id_popula).prop('disabled', false);

                    //Popula a filtering com as opções
                    for (i in object) {

                        var option = $('<option/>');
                        option.attr('value', object[i].id).text(object[i].label);

                        $('#' + id_popula).append(option);

                    }

                    if (valor) {
                        $('#' + id_popula).val(valor);
                        $('#' + id_popula).trigger('change');
                    }

                } else {
                    //Desabilita o campo a ser populado
                    $('#' + id_popula).prop('disabled', true);
                }

            },
            error: function (erro) {
                console.log(erro);
            }
        });
    };

    /**
     * Popula a filtering select
     */
    this.populaFilteringGet = function (id_popula, url_popula, valueCampo, valor, callback) {

        geral.loading(true);

        //Popula a grid de paramclientes
        $.ajax({
            type: "GET",
            url: url_popula,
            dataType: "json",
            success: function (object) {

                //Remove os elementos atuais
                $('#' + id_popula).children().remove();

                if (valueCampo != '') {

                    //Habilita o campo a ser populado
                    $('#' + id_popula).prop('disabled', false);

                    var option = $('<option/>');
                    option.attr('value', '').text('');

                    $('#' + id_popula).append(option);

                    //Popula a filtering com as opções
                    for (i in object) {

                        var option = $('<option/>');
                        option.attr('value', object[i].id).text(object[i].name);

                        $('#' + id_popula).append(option);

                    }

                    if (valor) {
                        $('#' + id_popula).val(valor);
                        $('#' + id_popula).trigger('change');
                    }

                    //Executa a função enviada de callback
                    if (callback) {
                        eval('callback()');
                    }

                } else {
                    //Desabilita o campo a ser populado
                    $('#' + id_popula).prop('disabled', true);
                }

                geral.loading(false);

            },
            error: function (erro) {
                console.log(erro);
            }
        });
    };


    /*
     * Faz o mesmo que função chr do php
     */
    this.chr = function (codePt) {
        // http://kevin.vanzonneveld.net
        // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +   improved by: Brett Zamir (http://brett-zamir.me)
        // *     example 1: chr(75);
        // *     returns 1: 'K'
        // *     example 1: chr(65536) === '\uD800\uDC00';
        // *     returns 1: true
        if (codePt > 0xFFFF) { // Create a four-byte string (length 2) since this code point is high
            //   enough for the UTF-16 encoding (JavaScript internal use), to
            //   require representation with two surrogates (reserved non-characters
            //   used for building other characters; the first is "high" and the next "low")
            codePt -= 0x10000;
            return String.fromCharCode(0xD800 + (codePt >> 10), 0xDC00 + (codePt & 0x3FF));
        }
        return String.fromCharCode(codePt);
    };

    /*
     * Faz o mesmo que função number_format do php
     */
    this.number_format = function (number, decimals, dec_point, thousands_sep) {
        // http://kevin.vanzonneveld.net
        // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
        // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +     bugfix by: Michael White (http://getsprink.com)
        // +     bugfix by: Benjamin Lupton
        // +     bugfix by: Allan Jensen (http://www.winternet.no)
        // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
        // +     bugfix by: Howard Yeend
        // +    revised by: Luke Smith (http://lucassmith.name)
        // +     bugfix by: Diogo Resende
        // +     bugfix by: Rival
        // +      input by: Kheang Hok Chin (http://www.distantia.ca/)
        // +   improved by: davook
        // +   improved by: Brett Zamir (http://brett-zamir.me)
        // +      input by: Jay Klehr
        // +   improved by: Brett Zamir (http://brett-zamir.me)
        // +      input by: Amir Habibi (http://www.residence-mixte.com/)
        // +     bugfix by: Brett Zamir (http://brett-zamir.me)
        // +   improved by: Theriault
        // +      input by: Amirouche
        // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // *     example 1: number_format(1234.56);
        // *     returns 1: '1,235'
        // *     example 2: number_format(1234.56, 2, ',', ' ');
        // *     returns 2: '1 234,56'
        // *     example 3: number_format(1234.5678, 2, '.', '');
        // *     returns 3: '1234.57'
        // *     example 4: number_format(67, 2, ',', '.');
        // *     returns 4: '67,00'
        // *     example 5: number_format(1000);
        // *     returns 5: '1,000'
        // *     example 6: number_format(67.311, 2);
        // *     returns 6: '67.31'
        // *     example 7: number_format(1000.55, 1);
        // *     returns 7: '1,000.6'
        // *     example 8: number_format(67000, 5, ',', '.');
        // *     returns 8: '67.000,00000'
        // *     example 9: number_format(0.9, 0);
        // *     returns 9: '1'
        // *    example 10: number_format('1.20', 2);
        // *    returns 10: '1.20'
        // *    example 11: number_format('1.20', 4);
        // *    returns 11: '1.2000'
        // *    example 12: number_format('1.2000', 3);
        // *    returns 12: '1.200'
        // *    example 13: number_format('1 000,50', 2, '.', ' ');
        // *    returns 13: '100 050.00'
        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    };

    /*
     * Remove mascara de reais "R$ 2.000,00"
     * @param valor string
     * $return string
     */
    this.removeMaskVal = function (valor) {

        var str = 0;
        if (valor != '') {
            //Remove o simbolo de R$, remove todos os pontos, remove as virgulas e coloca ponto
            str = valor.replace("R$ ", "").replace(".", "").replace(",", ".");
        }

        return parseFloat(str);

    };

    /*
     * Pega os valores de todos os campos do form inclusive dos campos disabled
     */
    this.serializeAll = function (formId) {
        var myform = $('#' + formId);

        // Pesquisa todos os campos disabled e remove de disabled
        var disabled = myform.find(':input:disabled').removeAttr('disabled');

        // serialize o form
        var serialized = myform.serialize();

        // Adiciona disabled novamente
        disabled.attr('disabled', 'disabled');

        return serialized;

    };
    /*
     * Pega os valores de todos os campos do form inclusive dos campos disabled e tranforma em objeto
     */
    this.serializeObject = function (formId)
    {
        var myform = $('#' + formId);

        // Pesquisa todos os campos disabled e remove de disabled
        var disabled = myform.find(':input:disabled').removeAttr('disabled');
        var o = {};
        var a = myform.serializeArray();
        $.each(a, function () {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });

        // Adiciona disabled novamente
        disabled.attr('disabled', 'disabled');

        return o;
    };
    this.replaceAll = function (string, token, newtoken) {

        while (string.indexOf(token) != -1) {
            string = string.replace(token, newtoken);
        }
        return string;
    };

    this.consultarEndCep = function (cep, callFunc) {

        $.ajax({
            type: "GET",
            url: 'http://cep.republicavirtual.com.br/web_cep.php?cep=' + cep + '&formato=json',
            dataType: "json",
            success: callFunc,
            error: function (erro) {
                console.log(erro);
            }
        });
    }
}