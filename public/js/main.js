$('#btn_buy').on('click', function (e) {
    e.preventDefault();
    $('#form_all').addClass('active');
    $('#form-buy').removeClass('clear');
});
$('#close').on('click', function (e) {
    e.preventDefault();
    $('#form_all').removeClass('active');
});

$('#buy_product').on('click', function (e) {
    e.preventDefault();
    $.ajax({
        url: '/order/store',
        type: 'POST',
        data: $('#form-buy').serialize()
    }).done(function (resultat) {
        switch (resultat) {
            case 'ok':
                $('#outmessage').html('<p>Заявка принята!<br>Наш менеджер свяжется с Вами!</p>');
                $('#form-buy')[0].reset();
                $('#form-buy').addClass('clear');

                break;
            default:
                $('#outmessage').html('<span>' + resultat + '</span>');
                break;
        }
    })
        .fail(function () {
            $('#outmessage').html(resultat)
        })
});
