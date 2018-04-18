
$('#buy_product').on('click', function (e) {
    e.preventDefault();
   // var formData = new FormData($('.form-horizontal')[0]);
    // if ($('input[type=file]')[0]) {
    //     formData.append('file', $('input[type=file]')[0].files[0]);
    // }
    $.ajax({
        url: '/order/store',
        type: 'POST',
        data: $('#form-buy').serialize()
        //data: formData, // Данные которые мы передаем
 //        cache: false, // В запросах POST отключено по умолчанию, но перестрахуемся
 //        contentType: false, // Тип кодирования данных мы задали в форме, это отключим
 //        processData: false,
 // dataType:'json'
    }).done(function (resultat) {
        $('#outmessage').html(resultat)
        //console.log(resultat);
        // switch (resultat) {
        //     case 'not empty':
        //         $('#outmessage').html('Не все поля заполнены!');
        //         break;
        //     default:
        //         break;
        // }
    })
        .fail(function() {
            $('#outmessage').html(resultat)
        })
});
