var offset =  [];
var offsetGroup = [];
var permArray = [];
var idPerm;

$(function (){

tabItem();
enviarPerm();
enviarGroup();
carregarTabelaPerm();
carregarTabelaGroup();
populateTablePermission();
populateTabelaGroup();
carregarPerm();
chkPerm();

    function tabItem() {
        $('.tabitem').on('click', function() {
            $('.activetab').removeClass('activetab');
            $(this).addClass('activetab');

            var item = $('.activetab').index();
            $('.tabbody').hide();
            $('.tabbody').eq(item).show();
        });
    }

    $('.tabbody').eq(0).show();

    function enviarPerm() {
        $('#btn_add_perm').on('click', function () {
            var nome = $('input[name="nome"]').val();

            var int = 'Add';

            if (nome != '')
            {
                $.ajax({
                    url: BASE_URL + '/Permissions',
                    type: 'POST',
                    data: {nome: nome, int :int },
                    dataType: 'json',
                    success: function(json) {
                        if (json == '1')
                        {
                            $('.message').removeClass('warn').addClass('sucesso').html('A Permissão '+nome+' foi enviado com sucesso !');
                            $('input').val('');
                        }
                        else
                        {
                            $('.message').removeClass('sucesso').addClass('warn').html('Oops, ocorreu um errro. A Permissão: '+json+' não foi enviada !');
                            $('input').val('');
                        }
                    }
                });
            }
            else
            {
                $('.message').removeClass('sucesso').addClass('warn').html('Por favor um ou mais campos estão vazios !');
                $('input').val('');
                $('input[name="nome"]').focus();
            }

            return false;
        });
    }

    function enviarGroup() {
        $('#btn_add_group').on('click', function () {
            var nome = $('input[name="nome_group"]').val();
            var groups = [];
            $('input[name="permissions[]"]:checked').each(function(){
                groups.push($(this).attr('id'));
            });

            var permissions = groups;

            var int = 'AddGroup';

            if (nome != '')
            {
                $.ajax({
                    url: BASE_URL + '/Permissions',
                    type: 'POST',
                    data: {nome: nome, permissions:permissions, int :int },
                    dataType: 'json',
                    success: function(json) {
                        if (json == '1')
                        {
                            $('.message').removeClass('warn').addClass('sucesso').html('A Permissão '+nome+' foi enviado com sucesso !');
                            $('input').val('');
                            cleanCheckBox();
                            carregarTabelaGroup();
                        }
                        else
                        {
                            $('.message').removeClass('sucesso').addClass('warn').html('Oops, ocorreu um errro. A Permissão: '+json+' não foi enviada !');
                            $('input').val('');
                            cleanCheckBox();
                        }
                    }
                });
            }
            else
            {
                $('.message').removeClass('sucesso').addClass('warn').html('Por favor um ou mais campos estão vazios !');
                $('input').val('');
                cleanCheckBox();
                $('input[name="nome_group"]').focus();
            }

            return false;
        });
    }

    function carregarTabelaPerm() {
        var int = 'tabelaPerm';

        $.ajax({

            url: BASE_URL + '/Permissions',
            type: 'POST',
            data: {int: int},
            dataType: 'json',
            success: function (jsonPerm) {


                var offsetTotal = 5;
                var distintOffset = [];
                offset = [];

                for (var j = 0; j < jsonPerm.length; j++) {
                    var key = Math.trunc(j / offsetTotal);
                    //
                    offset[key] = ((offset[key] != undefined) ? offset[key] : []);
                    offset[key].push(jsonPerm[j]);

                    if (distintOffset.indexOf(key) == -1) {
                        $('#pagination').append('<div class="pag_item"><a y="' + key + '" href="">' + (key + 1) + '</a></div>');
                        distintOffset.push(key);
                    }

                    $('#pagination a[y="0"]').click();
                }

            },
            error: function (jsonPerm) {
                alert("Erro: " + jsonPerm.status);
            }
        });
    }

    function carregarTabelaGroup() {
        var int = 'tabelaGroup';

        $.ajax({

            url: BASE_URL + '/Permissions',
            type: 'POST',
            data: {int: int},
            dataType: 'json',
            success: function (jsonGroup) {


                var offsetTotal = 5;
                var distintOffset = [];
                offsetGroup = [];

                for (var j = 0; j < jsonGroup.length; j++) {
                    var key = Math.trunc(j / offsetTotal);
                    //
                    offsetGroup[key] = ((offsetGroup[key] != undefined) ? offsetGroup[key] : []);
                    offsetGroup[key].push(jsonGroup[j]);

                    if (distintOffset.indexOf(key) == -1)
                    {
                        $('#paginationGroup').append('<div class="pag_item"><a y="' + key + '" href="">' + (key + 1) + '</a></div>');
                        distintOffset.push(key);
                    }

                    $('#paginationGroup a[y="0"]').click();
                }

            },
            error: function (jsonGroup) {
                alert("Erro: " + jsonGroup.status);
            }
        });
    }

    function populateTablePermission() {
        $('#pagination').on('click', 'a', function ()
        {
            $('tbody').empty();
            var pageActive = Number($(this).attr('y'));

            //remover a classe "pag_ativo" da pagina selecionada e adicionar a classe "pag_ativo" pra nova pagina ativada
            $('.pag_item a').removeClass('pag_ativo');
            $(this).addClass('pag_ativo');

            jsonPerm = offset[pageActive];

            for (var i = 0; i < jsonPerm.length; i++) {

                $('#tabbodyPerm').append(
                    '<tr id="' + jsonPerm[i].id + '">' +
                    '<td style="width: 85%">' + jsonPerm[i].nome + '</td>' +
                    '<td style="width: 15%">' +
                    '<div style="width: 50%" class="button_small"><a style ="color: #0f9d58" href="#openModalEdit" id="' + jsonPerm[i].id + '">Editar</a></div>' +
                    '<div style="width: 50%" class="button_small"><a style="color: #ff5252" name="btn_delet_usr" id="' + jsonPerm[i].id + '">Excluir</a></div>' +
                    '</td>' +
                    '</tr>'
                );
            }
        });
    }

    function populateTabelaGroup() {
        $('#paginationGroup').on('click', 'a', function () {

            $('tbody').empty();
            var pageActive = Number($(this).attr('y'));

            //remover a classe "pag_ativo" da pagina selecionada e adicionar a classe "pag_ativo" pra nova pagina ativada
            $('.pag_item a').removeClass('pag_ativo');
            $(this).addClass('pag_ativo');

            jsonGroup = offsetGroup[pageActive];

            for (var i = 0; i < jsonGroup.length; i++) {

                $('#tabbodyGroup').append(
                    '<tr id="' + jsonGroup[i].id + '">' +
                    '<td style="width: 85%">' + jsonGroup[i].name + '</td>' +
                    '<td style="width: 15%">' +
                    '<div style="width: 50%" class="button_small"><a style ="color: #0f9d58" href="#openModalEdit" id="' + jsonGroup[i].id + '">Editar</a></div>' +
                    '<div style="width: 50%" class="button_small"><a style="color: #ff5252" name="btn_delet_usr" id="' + jsonGroup[i].id + '">Excluir</a></div>' +
                    '</td>' +
                    '</tr>'
                );
            }
            return false;
        });
    }

    function chkPerm() {
        var int = 'chekPerm';

        $.ajax({
            url: BASE_URL + '/Permissions',
            type: 'POST',
            data: { int: int },
            dataType: 'json',
            success: function(json) {
                for(var i = 0; i < json.length; i++)
                {
                    $('#Group_perm').append(
                        '<div class="p_item">'+
                            '<input type="checkbox" name="permissions[]" value="'+json[i].id+'" id="'+json[i].id+'"/>'+
                            '<label for="'+json[i].id+'">'+json[i].nome+'</label>'+
                        '</div>'
                    );
                }

            }
        });
    }

    function cleanCheckBox() {
        var chk = $('input[type=checkbox]');
        chk.attr('checked', false);
        chk.prop('checked', false);
    }

    function carregarPerm() {

        var int = 'perm';

        $.ajax({

            url: BASE_URL + '/Permissions',
            type: 'POST',
            data: {int: int},
            dataType: 'json',
            success: function (json) {

                permArray = [];

                for (var j = 0; j < json.length; j++) {
                    var key = Math.trunc(j);

                    permArray[key] = ((permArray[key] != undefined) ? permArray[key] : []);
                    permArray[key].push(json[j]);
                }

            },
            error: function (json) {
                alert("Erro: " + json.status);
            }
        });
    }


});