<script>
$('.payme').css('display','none');
$('.sms-payme').css('display','none');
$('#payme-submit').hide();
$(".success").css("display","none");

    let id = 'F' + Math.floor(Math.random() * 100);
    let paymeOrderId;
    let tokennum;
    let time;

    var createData = {
        "id": '',
        "method": '',
        "params": {
            "card": {"number": '', "expire": ''},
            "amount": '',
            "save": ''
        }
    };

    var token_send = {
        "id": '',
        "method": '',
        "params": {
            "token": ""
        }
    };

    var smsData = {
        "id": '',
        "method": '',
        "params": {
            "token": '',
            "code": ''
        }
    };

    var lastStepPaymeUz = {
        'order_id': '',
        'token': '',
    };

$(".cancel-payme").click(function(e) {
    e.preventDefault()
    $('.choose').css('display','block');
    $('.payme').css('display','none');
})
function countDownPayme(secs, elem){
    var element = document.getElementById(elem);
    element.innerHTML = "( " + secs + " sec )";
    if(secs < 1){
        clearTimeout(timer);
        element.innerHTML = '0';
        $("#p_sms_code").prop('disabled', true);
        $(".pay-payme").prop('disabled', true);
        return false;
    }
    secs--;
    var timer = setTimeout('countDownPayme('+secs+',"'+elem+'")', 1000);

}
function errorPayme(err_container, err) {
    $(err_container).html('<p class="error-message" style="text-align: center">'+err+'</p>');
}

$('.payme-choose').submit(function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-Auth': $('#payme_merchant_id').val()
        }
    });
    let clientInfo = {
        "doctor_id": '',
        "clinic_id": '',
        "amount": '',
        "booking_date": '',
        "time_start": '',
        "description": ''
    };
    var bookAr = $("#booking_date").val().split("/");
    var bookTime = bookAr[2] + "-" + bookAr[0] + "-" + bookAr[1];
    clientInfo.doctor_id = $('#doctor_id').val();
    clientInfo.clinic_id = $('#clinic_id').val();
    clientInfo.amount = 15000;
    clientInfo.booking_date = bookTime;
    clientInfo.time_start = $('#time_start').val();
    clientInfo.description = $('#description').val();
    
    $.ajax({
        url: '/book/paycom/create',
        method: "POST",
        data: clientInfo,
        dataType: "json",
        success: function (data) {
            console.log("success")
            paymeOrderId = data.data.order_id;
            $('.choose').css('display','none');
            $('.payme').css('display','block');
        },

        error: function(data) {
            console.log(data)
            $('.payme').css('display','none');
            $('.choose').css('display','block');
            document.getElementsByClassName(".error-container").innerHTML += data.responseJSON.message;
        }
    })
});
// $(".confirm-payme").hide();
$(".confirm").click(function(e) {
    e.preventDefault();
    console.log( $('#payme_merchant_id').val())
    console.log( $('#p_card_number').val())
    console.log( $('#p_expire_month').val() + $('#p_expire_year').val())
});

$(".confirm-payme").click(function(e) {
    e.preventDefault();
    $('.payme').css('display','none');
    $.ajaxSetup({
        headers: {
            "X-Auth" : $('#payme_merchant_id').val(),
        }
    });
    createData.id = id;
    createData.method= "cards.create";
    createData.params.card.number = $('#p_card_number').val();
    createData.params.card.expire = $('#p_expire_month').val() + $('#p_expire_year').val();
    createData.params.amount = 1500000;
    createData.params.save = false;
    delete $.ajaxSettings.headers['X-CSRF-TOKEN'];
    delete $.ajaxSettings.headers['XSRF-TOKEN'];
    // 1
    $.ajax({
        url: "https://cors-anywhere.herokuapp.com/https://checkout.test.paycom.uz/api",
        method: "POST",
        data: JSON.stringify(createData),
        dataType: "json",
        success: function(data) {
            if(data.error) {
                errorPayme(".error-container", data.error.message)
            } else {
                $('.sms-payme').css('display','block');
                token_send.id = id;
                token_send.method = "cards.get_verify_code";
                token_send.params.token = data.result.card.token;
                tokennum = data.result.card.token;
                $.ajaxSetup({
                    headers: {
                        'X-Auth' : $('#payme_merchant_id').val()
                    }
                });
                //2
                $.ajax({
                    url: "https://cors-anywhere.herokuapp.com/https://checkout.test.paycom.uz/api",
                    method: "POST",
                    data: JSON.stringify(token_send),
                    dataType: "json",
                    success: function(data) {
                        if(data.result.sent === true){
                            time = data.result.wait;
                            time = time/1000;
                            time = time - 1;
                            countDownPayme(time, "countDown");
                            $(".pay-payme").click(function(e) {
                                e.preventDefault();
                                $("#sms-payme").css("display","none");
                                smsData.id = id;
                                smsData.method = "cards.verify";
                                smsData.params.code = $('#p_sms_code').val();
                                smsData.params.token = tokennum;
                                $.ajaxSetup({
                                    headers: {
                                        'X-Auth' : $('#payme_merchant_id').val()
                                    }
                                });
                                //3
                                $.ajax({
                                    url: "https://cors-anywhere.herokuapp.com/https://checkout.test.paycom.uz/api",
                                    method: "POST",
                                    data: JSON.stringify(smsData),
                                    dataType: "json",
                                    success: function(data) {
                                        console.log("Oh my god");
                                        if(data.error){
                                            errorPayme(".error-container", data.error.message)
                                        } else if(data.result.card.verify) {
                                            lastStepPaymeUz.order_id = paymeOrderId;
                                            lastStepPaymeUz.token = tokennum;
                                            console.log(lastStepPaymeUz);
                                            $.ajaxSetup({
                                                headers:{
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                                    'XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                                    'X-Auth': $('#paycom_merchant_id').val()
                                                }
                                            })
                                            document.getElementsByClassName("error-container").innerHTML = '';
                                            $.ajax({
                                                url: '/book/paycom/perform',
                                                method: "POST",
                                                data: lastStepPaymeUz,
                                                dataType: 'json',
                                                success: function(data){
                                                    console.log("Finish: ");
                                                    console.log(data);
                                                    $(".success").css("display","block");
                                                    $(".success").html("<h2> Your queue number: " + data.data.book_id + "</h2>");

                                                },
                                                error: function(data){
                                                    errorPayme(".error-container", data.responseJSON.message)
                                                }
                                            })
                                        } else if (!data.result.card.verfy){
                                            errorPayme(".error-container", data.error.message)
                                        }
                                    },
                                    error: function() {
                                        errorPayme(".error-container", data.error.message)
                                    }
                                })
                            })
                        } else {
                            errorPayme(".error-container", data.error.message)
                        }
                    },
                    error: function(data) {
                        errorPayme(".error-container", data.error.message)
                    }
                });
            }
        },
        error: function(data) {
            console.log(data)
            errorPayme(".error-container", data.error.message);
        },
    });

})

</script>
