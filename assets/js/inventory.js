$(function () {


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

});