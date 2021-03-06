var offsetClients = [];


$(function() {

    enviar();
    update();
    excluir();
    buscaCEP();
    buscaClients();
    carregarTabelaClients();
    populateTableclients();

    function enviar() {
        $('#btn_add_cli').on('click', function() {

            var first_name = $('input[name="first_name"]').val();
            var last_name = $('input[name="last_name"]').val();
            var email = $('input[name="email"]').val();
            var phone = $('input[name="phone"]').val();
            var stars = $('select[name="stars"]').val();
            var internal_obs = $('textarea[name="internal_obs"]').val();
            var address_zipcode = $('input[name="address_zipcode"]').val();
            var address = $('input[name="address"]').val();
            var address2 = $('input[name="address2"]').val();
            var address_number = $('input[name="address_number"]').val();
            var address_neighb = $('input[name="address_neighb"]').val();
            var address_city = $('input[name="address_city"]').val();
            var address_state = $('input[name="address_state"]').val();
            var address_country = $('input[name="address_country"]').val();

            var int = 'Add';

            if (first_name != '' && last_name != '') {
                $.ajax({
                    url: BASE_URL + '/Clients',
                    type: 'POST',
                    data: {
                        first_name: first_name,
                        last_name: last_name,
                        email: email,
                        phone: phone,
                        address: address,
                        address_neighb: address_neighb,
                        address_city: address_city,
                        address_state: address_state,
                        address_country: address_country,
                        address_zipcode: address_zipcode,
                        stars: stars,
                        internal_obs: internal_obs,
                        address2: address2,
                        address_number: address_number,
                        int: int
                    },
                    datatype: 'json',
                    success: function(json) {
                        if (json == '1') {
                            $('#message').removeClass('warn').addClass('sucesso').html('Cliente: ' + first_name + ' ' + last_name + ' foi inserido com sucesso!');
                            $('input').val('');
                        } else {
                            $('#message').removeClass('sucesso').addClass('warn').html('Ocorreu algum erro ao fazer inserção do Cliente! Por favor entre em contacto com administração do sistema !');
                            $('input').val('');
                        }
                    }
                });
            } else {
                $('#message').removeClass('sucesso').addClass('warn').html('Por favor preencha pelos menos o <Strong>Primeiro Nome</Strong> e o <Strong>Ultímo Nome</Strong> !');
                $('input').val('');
                $('input[name="email"]').focus();
            }

            return false;
        });
    }

    function update() {
        $('a[name=btnTableEdit]').on('click', function() {

            var id = $(this).attr('id');

            var int = 'Edit';

            if (id != '') {
                $.ajax({
                    url: BASE_URL + '/Clients',
                    type: 'POST',
                    data: { id: id, int: int },
                    dataType: 'json',
                    success: function(json) {

                    }
                });
            } else {

            }


            return false;
        });
    }

    function buscaCEP() {
        $('input[name=address_zipcode]').on('blur', function() {
            var nct_cep = $(this).val();

            $.ajax({
                url: 'http://api.postmon.com.br/v1/cep/' + nct_cep,
                type: 'GET',
                dataType: 'json',
                success: function(json) {
                    if (typeof json.logradouro != undefined) {
                        $('input[name=address]').val(jason.logradouro);
                        $('input[name=address_neighb]').val(jason.bairro);
                        $('input[name=address_city]').val(jason.cidade);
                        $('input[name=address_state]').val(jason.estado);
                        $('input[name=address_country]').val("Brasil");
                        $('input[name=address_number]').focus();
                    }
                }
            });
        });
    }

    function buscaClients() {
        $('#busca').on('keyup', function() {
            var datatype = $(this).attr('data-type');
            var qVal = $(this).val();

            if (datatype != '') {
                $.ajax({
                    url: BASE_URL + '/Ajax/' + datatype,
                    type: 'POST',
                    data: { q: qVal },
                    dataType: 'json',
                    success: function(json) {

                        if ($('.searchresults').length == 0) {
                            $('#busca').after('<div class="searchresults"></div>')
                        }
                        $('.searchresults').css('left', $('#busca').offset().left + 15 + 'px');
                        $('.searchresults').css('top', $('#busca').offset().top + $('#busca').height() + 11 + 'px');
                        $('.searchresults').css('display = "block');

                        var html = '';

                        for (var i in json) {
                            html += '<div class = "it"><a href="' + json[i].link + '">' + json[i].name + '</a></div>';
                        }

                        $('.searchresults').html(html);

                        $('.searchresults').show();

                    }
                });
            }
        });
    }

    function carregarTabelaClients() {
        var int = 'tabela';

        $.ajax({
            url: BASE_URL + '/Clients',
            type: 'POST',
            data: { int: int },
            dataType: 'json',
            success: function(datajson) {
                if (datajson != '') {
                    var offsetTotal = 5;
                    var distintOffset = [];
                    offsetClients = [];

                    for (var j = 0; j < datajson.length; j++) {
                        var key = Math.trunc(j / offsetTotal);
                        //
                        offsetClients[key] = ((offsetClients[key] != undefined) ? offsetClients[key] : []);
                        offsetClients[key].push(datajson[j]);

                        if (distintOffset.indexOf(key) == -1) {
                            $('#pagination').append('<div class="pag_item"><a y="' + key + '" href="">' + (key + 1) + '</a></div>');
                            distintOffset.push(key);
                        }
                    }
                    $('#pagination a[y="0"]').click();
                } else {
                    alert('erro json vazio');
                }
            }

        });
    }

    function populateTableclients() {
        $('#pagination').on('click', 'a', function() {
            $('tbody').empty();
            var pageActive = Number($(this).attr('y'));

            //remover a classe "pag_ativo" da pagina selecionada e adicionar a classe "pag_ativo" pra nova pagina ativada
            $('.pag_item a').removeClass('pag_ativo');
            $(this).addClass('pag_ativo');

            datajson = offsetClients[pageActive];
            for (var i = 0; i < datajson.length; i++) {

                $('tbody').append(
                    '<tr id="' + datajson[i].id + '">' +
                    '<td style="width: 38%; text-align: left">' + datajson[i].first_name + ' ' + datajson[i].last_name + '</td>' +
                    '<td style="width: 15%; text-align: left">' + datajson[i].phone + '</td>' +
                    '<td style="width: 30%; text-align: left">' + datajson[i].address + '</td>' +
                    '<td style="width: 10%; text-align: left">' + datajson[i].stars + '</td>' +
                    '<td style="width: 7%; text-align: center">' +
                    '<div style="width: 100%" class="button_small"><a style="color: #ff5252" name="btn_delet_clients" id="' + datajson[i].id + '">Excluir</a></div>' +
                    '</td>' +
                    '</tr>'
                );


            }

            return false;
        });
    }

    function excluir() {
        $('tbody').on('click', "a[name='btn_delet_clients']", function() {
            var id = $(this).attr('id');

            var int = 'delet';

            if (id != '') {

                $.ajax({
                    url: BASE_URL + '/Clients',
                    type: 'POST',
                    data: { id: id, int: int },
                    dataType: 'json',
                    success: function(json) {
                        $('#pagination').empty();
                        carregarTabelaClients();
                    }
                });
            } else {

            }
            return false;
        });
    }

});