
var offset = [];
var option = [];

var idUsr;

$(function() {

    enviar();
    modalEdit();
    carregarTabela();
    excluir();
    select();
    update();
    populateTableUsr();

    function enviar() {
        $('#btn_add_usr').on('click', function() {

            var email = $('input[name="email"]').val();
            var password = $('input[name="password"]').val();
            var groups = $('select[name="groups"]').val();

            var int = 'Add';

            if (email != '' && password != '' && groups != '') {
                $.ajax({
                    url: BASE_URL + '/Users',
                    type: 'POST',
                    data: { email: email, password: password, groups: groups, int: int },
                    datatype: 'json',
                    async: false,
                    success: function(json) {
                        if (json == '1') {
                            $('#message').removeClass('warn').addClass('sucesso').html('Usuário ' + email + ' foi cadastrado com sucesso !');
                            $('input').val('');
                            carregarTabela();
                        } else {
                            $('#message').removeClass('sucesso').addClass('warn').html('Usuário com o email: ' + email + ' já existe !');
                            $('input').val('');
                        }
                    }
                });
            } else {
                $('#message').removeClass('sucesso').addClass('warn').html('Por favor um ou mais campos estão vazios !');
                $('input').val('');
                $('input[name="email"]').focus();
            }

            return false;
        });
    }

    function excluir() {
        $('tbody').on('click',"a[name='btn_delet_usr']", function() {
            var id = $(this).attr('id');

            var int = 'Delet';

            if (id != '') {
                $.ajax({
                    url: BASE_URL + '/Users',
                    type: 'POST',
                    data: {id: id, int :int },
                    dataType: 'json',
                    success: function(json) {
                        carregarTabela();
                    }
                });
            } else {

            }
            return false;
        });
    }

    function modalEdit() {
        $('tbody').on('click',"a[name='btn_updat_usr']", function() {

            location.href="#openModalEdit";


            var pagAtive = Number($(this).attr('pageAtive'));
            var position = Number($(this).attr('position'));

            var opt = offset[pagAtive][position].name;
            idUsr = offset[pagAtive][position].id;
            $('label[for=email]').text(offset[pagAtive][position].email);
            var selet = $('.groupsPerm').find('option:contains("' + opt + '")').attr('value');
            $('.groupsPerm').val(selet);

            return false;
        });
    }

    function update() {
        $('#btn_update_usr').on('click', function() {

            var int = 'Update';

            var password = $('input[name="passwordEdit"]').val();
            var groups = $('select[name="groupsEdit"]').val();
            var id = idUsr;


            if (id != '') {

                $.ajax({
                    url: BASE_URL + '/Users',
                    type: 'POST',
                    data: { id: id, password: password, groups: groups, int: int },
                    dataType: 'json',
                    async: false,
                    success: function(json) {
                        if (json == '1') {
                            $('.message').removeClass('warn').addClass('sucesso').html('Usuário foi actualizado com sucesso !');
                            $('input').val('');
                            carregarTabela();
                        } else {
                            $('.message').removeClass('sucesso').addClass('warn').html('Ocorreu um erro ao atualizar o Usuário !');
                            $('input').val('');
                        }
                    }
                });
            } else {
                $('.message').removeClass('sucesso').addClass('warn').html('Por favor um ou mais campos estão vazios !');
                $('input').val('');
                $('input[name="email"]').focus();
            }

            return false;
        });
    }

    function carregarTabela() {
        var int = 'tabela';
        $.ajax({
            type: "POST",
            url: BASE_URL + '/Users',
            data: { int: int },
            dataType: 'json',
            success: function(json) {

                var offsetTotal = 5;
                var distintOffset = [];
                offset = [];

                for (var j = 0; j < json.length; j++){
                    var key =Math.trunc(j/ offsetTotal);
                    //
                    offset[key] = ((offset[key] != undefined)? offset[key]:[]);
                    offset[key].push(json[j]);

                    if (distintOffset.indexOf(key) == -1)
                    {
                        $('#pagination').append('<div class="pag_item"><a y="'+key+'" href="">'+(key+1)+'</a></div>');
                        distintOffset.push(key);
                    }

                    $('#pagination a[y="0"]').click();
                }
            },
            error: function(json) {
                alert("Erro: " + json.status);
            }
        });
    }

    function populateTableUsr() {
        $('#pagination').on('click', 'a', function () {
            $('tbody').empty();
            var pageActive = Number($(this).attr('y'));

            //remover a classe "pag_ativo" da pagina selecionada e adicionar a classe "pag_ativo" pra nova pagina ativada
            $('.pag_item a').removeClass('pag_ativo');
            $(this).addClass('pag_ativo');

            json = offset[pageActive];
            for (var i = 0; i < json.length; i++) {

                $('tbody').append(
                    '<tr id="' + json[i].id + '">' +
                    '<td style="width: 40%">' + json[i].email + '</td>' +
                    '<td style="width: 45%">' + json[i].name + '</td>' +
                    '<td style="width: 15%">' +
                    '<div style="width: 50%" class="button_small"><a style ="color: #0f9d58" pageAtive = "'+pageActive+'" position="'+i+'" name="btn_updat_usr" id="' + json[i].id + '">Editar</a></div>' +
                    '<div style="width: 50%" class="button_small"><a style="color: #ff5252" name="btn_delet_usr" id="' + json[i].id + '">Excluir</a></div>' +
                    '</td>' +
                    '</tr>'
                );


            }

            return false;
        });
    }

    function select() {

        var int = 'option';

        $.ajax({
            url: BASE_URL + '/Users',
            type: 'POST',
            data: { int: int },
            dataType: 'json',
            success: function(json) {
                for(var i = 0; i < json.length; i++)
                {

                    option = json[i];
                    $('.groupsPerm').append(
                        '<option value="'+json[i].id+'" name="'+json[i].name+'">'+json[i].name+'</option>'
                    );
                }

            }
        });
    }

});