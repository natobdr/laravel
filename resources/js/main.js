$(document).on('blur', '#cep', function (){
    const cep = $(this).val();
    $.ajax({
        url: 'https://viacep.com.br/ws/'+cep+'/json/',
        method: 'GET',
        dataType: 'json',
        success: function (data){
            $('#logradouro').val(data.logradouro);
            $('#bairro').val(data.bairro);
            $('#cidade').val(data.localidade);
            $('#estado').val(data.uf);
        }
    });
});
