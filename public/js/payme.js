// $('.confirm-payme').click(function(e) {
//     $('.payme').css('display','none');
//     $('.sms-payme').css('display','block');
// });

// $('.confirm-click').click(function(e) {
//     $('.click').css('display','none');
//     $('.sms-click').css('display','block');
// });


$('.payme').css('display','none');
$('.click').css('display','none');
$('.sms-payme').css('display','none');
$('.sms-click').css('display','none');
$('.successed').css('display','none');

$('.choose-payme').click(function(e) {
    $('.choose').css('display','none');
    $('.payme').css('display','block');
});

$('.choose-click').click(function(e) {
    $('.choose').css('display','none');
    $('.click').css('display','block');
});

var id= 11;
var tokennum;
var time;

var createData = {
    id: 0,
    method: "",
    params: {
        card: {
            number: 0,
            expire: '',
        },
        amount: 0,
        save: true
    }
};
var verify_code_date = {
    id: 1,
    method: "",
    params: {
        token: ""
    }
}
var smsData = {
    id: 1,
    method: "",
    params: {
        token: ""
    }
}

function countDown(secs, elem){
    var element = document.getElementById(elem);
    element.innerHTML = ""+secs+" ";
    if(secs < 1){
        clearTimeout(timer);
        element.innerHTML = '0';
        $("#p_sms_code").prop('disabled', true);
        $(".pay-payme").prop('disabled', true);
        return false;
    }
    secs--;
    var timer = setTimeout('countDown('+secs+',"'+elem+'")', 1000);
}

function errorPayme(err_container, err) {
    $(err_container).html('<p class="error-message">'+err+'</p>');
}


$(".confirm-payme").click(function(e) {
    e.preventDefault();
    console.log( $('#payme_merchant_id').val())
    console.log( $('#p_card_number').val())
    console.log( $('#p_expire_month').val() + $('#p_expire_year').val())
    $.ajaxSetup({
        headers: {
            "X-Auth" : $('#payme_merchant_id').val(),
        }
    });
    createData.id = id;
    createData.method= "cards.create";
    createData.params.card.number = $('#p_card_number').val();
    createData.params.card.expire = $('#p_expire_month').val() + $('#p_expire_year').val();
    createData.params.amount = 2000000;
    createData.params.save = true;
    // delete $.ajaxSettings.headers['X-CSRF-TOKEN'];
    // delete $.ajaxSettings.headers['XSRF-TOKEN'];
    // 1
    $.ajax({
        url: "https://checkout.test.paycom.uz",
        method: "POST",
        data: JSON.stringify(createData),
        dataType: "json",
        success: function(data) {
            if(data.error) {
                console.log(data)
                errorPayme(".error-container", data.error.message)
            } else {
                console.log("Hello");
                verify_code_data.id = id;
                verify_code_data.method = "cards.get_verify_code";
                verify_code_data.params.token = data.result.card.token;
                tokennum = data.result.card.token;
                $('.payme').css('display','none');
                $('.sms-payme').css('display','block');
                $.ajaxSetup({
                    headers: {
                        'X-Auth' : $('#payme_merchant_id').val()
                    }
                });
                //2
                $.ajax({
                    url: "https://checkout.test.paycom.uz",
                    method: "POST",
                    data: JSON.stringify(verify_code_data),
                    dataType: "json",
                    success: function(data) {
                        if(data.result.sent === true){
                            time = data.result.wait;
                            time = time/1000;
                            time = time - 1;
                            countDown(time, "countDown");
                            $(".pay-payme").click(function(e) {
                                e.preventDefault();
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
                                    url: "https://checkout.test.paycom.uz/api",
                                    method: "POST",
                                    data: JSON.stringify(smsData),
                                    dataType: "json",
                                    success: function(data) {
                                        if(data.error){
                                            errorPayme(".error-container", data.error.message)
                                        } else if(data.result.card.verify) {
                                            $('.sms-payme').css('display', 'none');
                                            $('.successed').css('display', 'block');
                                            document.getElementsByClassName(".error-container").innerHTML = '';
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
            errorPayme(".error-container", data.error.message);
        },
    });
});
