var offset = [];



$(function () {

    carregarTableInventory();
    populateTableInventory();

    $('input[name=price]').mask('000.000.000.000.000,00', {reverse:true, placeholder:"0,00"});



    $('#btn_add_inv').on('click', function () {

        var name = $('input[name="name"]').val();
        var price = $('input[name="price"]').val();
        var quant = $('input[name="quant"]').val();
        var min_quant = $('input[name="min_quant"]').val();

        var int = 'Add';

        if (name != '' && price != '' && min_quant != '')
        {
            $.ajax({
                url: BASE_URL + '/Inventory',
                type: 'POST',
                data: {name:name, price:price, quant:quant, min_quant:min_quant, int:int },
                datatype: 'json',
                success: function(json) {
                    if (json == '1')
                    {
                        $('#message').removeClass('warn').addClass('sucesso').html('Produto '+name+' foi inserido com sucesso !');
                        $('input').val('');
                    }else
                    {
                        $('#message').removeClass('sucesso').addClass('warn').html('Houve algum problema ao inserir 0 produto: '+name+' !');
                        $('input').val('');
                    }
                }
            });
        }
        else
        {
            $('#message').removeClass('sucesso').addClass('warn').html('Por favor um ou mais campos estão vazios !');
            $('input').val('');
            $('input[name="email"]').focus();
        }

        return false;
    });

    function carregarTableInventory() {
        var int = 'tabela';
        $.ajax({
            url: BASE_URL + '/Inventory',
            type: 'POST',
            data: { int: int },
            dataType: 'json',
            success: function(json) {
                if (json != '')
                {
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
                    }
                    $('#pagination a[y="0"]').click();
                }
                else
                {
                    alert('erro json vazio');
                }
            }

        });
    }


    function populateTableInventory() {
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
                        '<td style="width: 45%">' + json[i].name + '</td>' +
                        '<td style="width: 20%">' + json[i].price + '</td>' +
                        '<td style="width: 15%">' + json[i].quant + '</td>' +
                        '<td style="width: 15%">' + json[i].min_quant + '</td>' +
                        '<td style="width: 15%">' +
                            '<div style="width: 50%" class="button_small"><a style ="color: #0f9d58" pageAtive = "'+pageActive+'" position="'+i+'" name="btn_updat_clients" id="' + json[i].id + '">Editar</a></div>' +
                            '<div style="width: 50%" class="button_small"><a style="color: #ff5252" name="btn_delet_clients" id="' + json[i].id + '">Excluir</a></div>' +
                        '</td>' +
                    '</tr>'
                );


            }

            return false;
        });
    }

});