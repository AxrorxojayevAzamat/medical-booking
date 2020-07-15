// paymeSMSFormElement = $("#payme-sms");
// $('#payme-sms-form').css('display', 'none');
// $(".spiner-payme-container").hide();


function countDown(secs, elem){
    var element = document.getElementById(elem);
    element.innerHTML = ""+secs+" ";
    if(secs < 1){
        clearTimeout(timer);
        element.innerHTML = '0';
        $("#smsInput").prop('disabled', true);
        $("#smsSendBtn").prop('disabled', true);
        return false;
    }
    secs--;
    var timer = setTimeout('countDown('+secs+',"'+elem+'")', 1000);
}

function errorFillerPayme(error_container, error) {
    $(error_container).html('<p class="error-message">'+error+'</p>');
}

$('#sendBtn').click(function(e){
    e.preventDefault();
    // $(".spiner-payme-container").show();
    $.ajaxSetup({
        headers: {
            'X-Auth' : $('#paycom_merchant_id').val(),
        }
    });

    formData.id = id;
    formData.method= "cards.create";
    formData.params.card.number =  $('#cardNumber').val();
    formData.params.card.expire =  $('#cardExpireDate').val();
    formData.params.amount = 100 * parseInt(splitedAmountId[1], 10);
    formData.params.save = false;
    delete $.ajaxSettings.headers['X-CSRF-TOKEN'];
    delete $.ajaxSettings.headers['XSRF-TOKEN'];
    $.ajax({
        url: "https://checkout.paycom.uz/api",
        method: "POST",
        data: JSON.stringify(formData),
        dataType: "json",
        success: function(data){
            if(data.error){
                $(".spiner-payme-container").hide();
                errorFillerPayme(".error-container", data.error.message)
            }
            else{
                token_send.id = id;
                token_send.method = "cards.get_verify_code";
                token_send.params.token = data.result.card.token;
                tokennum = data.result.card.token;
                paymeSMSFormElement.show();
                $('#paymeForm').css('display', 'none');
                $('#payme-card-form').css('display', 'none');
                $('#payme-card-form-info').css('display', 'none');
                $('payme-sms-form').css('display', 'block');
                $.ajaxSetup({
                    headers: {
                        'X-Auth' : $('#paycom_merchant_id').val()
                    }
                });
                $.ajax({
                    url: "https://checkout.paycom.uz/api",
                    method: "POST",
                    data: JSON.stringify(token_send),
                    dataType: "json",
                    success: function(data){
                        if(data.result.sent === true){
                            time = data.result.wait;
                            time = time/1000;
                            time = time - 1;
                            $(".spiner-payme-container").hide();
                            $("#smsSendBtn").prop('disable', false);
                            countDown(time, 'timer');
                            $("#smsSendBtn").click(function(e){
                                e.preventDefault();
                                $(".spiner-payme-container").show();
                                smsverify.id = id;
                                smsverify.method = "cards.verify";
                                smsverify.params.code = $('#smsInput').val();
                                smsverify.params.token = tokennum;
                                $.ajaxSetup({
                                    headers: {
                                        'X-Auth' : $('#paycom_merchant_id').val()
                                    } 
                                });
                                $.ajax({
                                    url: "https://checkout.paycom.uz/api",
                                    method: "POST",
                                    data: JSON.stringify(smsverify),
                                    dataType: "json",
                                    success: function(data){
                                        if(data.error){
                                            $(".spiner-payme-container").hide();
                                            errorFillerPayme(".error-payment", data.error.message)
                                        }
                                        else if(data.result.card.verify){
                                            lastStepPaymeUz.order_id = paymeOrderId;
                                            lastStepPaymeUz.token = tokennum;
                                            $.ajaxSetup({
                                                headers:{
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                                    'XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                                    'X-Auth': $('#paycom_merchant_id').val()
                                                }

                                            })
                                            document.getElementsByClassName(".error-container").innerHTML = '';
                                            $.ajax({
                                                url: '/booking/paycom/receipt',
                                                method: "POST",
                                                data: lastStepPaymeUz,
                                                dataType: 'json',
                                                success: function(data){
                                                    $(".spiner-payme-container").hide();
                                                    $("#result-booking").css('display', 'block');
                                                    $("#modal").css('display', 'none');
                                                    $('#clickuz-sms-form').css('display', 'none');
                                                    $("#reserve-number").css('display', 'none');
                                                    $("#success-payment").css('display', 'block');
                                                    $('body').removeClass(" no-scroll");
                                                    bookId(data.data.book_id);
                                                },
                                                error: function(data){
                                                    $(".spiner-payme-container").hide();
                                                    $("#result-booking").css('display', 'block');
                                                    $("#modal").css('display', 'none');
                                                    $("#reserve-number").css('display', 'none');
                                                    $('#clickuz-sms-form').css('display', 'none');
                                                    $("#error-payment-include").css('display', 'block');
                                                    $('body').removeClass(" no-scroll");
                                                    errorFillerPayme(".error-container", data.responseJSON.message)
                                                }
                                            })
                                        } else if (!data.result.card.verfy){
                                            $(".spiner-payme-container").hide();
                                            $(".error-container").html('<p class="error-message">'  + "{{trans('booking.verify_payment')}}" +'</p>');
                                        }

                                    },
                                    error: function(data){
                                        $(".spiner-payme-container").hide();
                                        errorFillerPayme(".error-container", data.error.message)
                                    } 
                                })
                            })
                        }else{
                            $(".spiner-payme-container").hide();
                            $(".error-container").show();
                            errorFillerPayme(".error-container", data.error.message)
                        }
                    },
                    error: function(data){
                        errorFillerPayme(".error-container", data.error.message)
                        $(".error-container").css('display', 'block');
                        $(".spiner-payme-container").hide();
                    }
                })
            }
        },
        
        error: function (data){
            $(".spiner-payme-container").hide();
            errorFillerPayme(".error-container", data.error.message)
        }

    });
});
