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

// $('.choose-payme').click(function(e) {
//     infoSendPaymeUz();
// });

// $('.choose-click').click(function(e) {
//     $('.choose').css('display','none');
//     $('.click').css('display','block');
// });

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
    delete $.ajaxSettings.headers['X-CSRF-TOKEN'];
    delete $.ajaxSettings.headers['XSRF-TOKEN'];
    // 1
    $.ajax({
        url: "https://checkout.test.paycom.uz/api",
        method: "POST",
        data: JSON.stringify(createData),
        dataType: "json",
        success: function(data) {
            if(data.error) {
                console.log(data)
                errorPayme(".error-container", data.error.message)
            } else {
                console.log("Hello");
                token_send.id = id;
                token_send.method = "cards.get_verify_code";
                token_send.params.token = data.result.card.token;
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
                    url: "https://checkout.test.paycom.uz/api",
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

function infoSendPaymeUz() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-Auth': $('#paycom_merchant_id').val()
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

    clientInfo.doctor_id = $('#doctor_id').val();
    clientInfo.clinic_id = $('#clinic_id').val();
    clientInfo.amount = "15000";
    clientInfo.booking_date = $('#booking_date').val();
    clientInfo.time_start = $('#time_start').val();
    clientInfo.description = "something";

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
        error: function (data) {
            console.log(data)
            $('.payme').css('display','none');
            $('.choose').css('display','block');
            document.getElementsByClassName(".error-container").innerHTML += data.responseJSON.message;
        }
    })
}


// let token_send = {
//     "id": '',
//     "method": '',
//     "params": {
//         "token": ""
//     }
// };
// let numberExists;
// let prefixInfo;
// let inputsNumberMask = $(".input-number-mask");
// let numberInfo;
// let categoryInfo;
// let modal = $('#modal');
// let priceInfo;
// let categoryId;
// let searchNotFound;
// let searchNumberNotFound;
// let regionId;
// let prefixVal;
// let cityValueCreate;
// let valuePaginationPage;
// let paginationPages;
// let languageCategory;
// let reservedNumberSection = $('#reserve-number');
// let lastStepPaymeUz = {
//     'order_id': '',
//     'token': '',
// };
// let cardNumber = $('#cardNumber');
// let cardExpireDate = $('#cardExpireDate');
// let sendbtn = $('#sendbtn');
// let tokennum = '';
// let manifestFileResponse;
// let urlJsonArray = [];
// let urlJson;
// let manifestFile = $.getJSON("/build/mix-manifest.json");
// let manifestJsonFile;
// let manifestJsonFileRegion;
// let manifestJsonFilePrefix;
// let matching = [];
// let booking_id;
// let jsonfile;
// let phone_id;
// let jsonfileJson;
// let clickMerchantTransId;

// let splitedAmountId;
// let containerSearchNumberBtn = $(".container-search-number-btn");
// let selectionContainer = $(".container-selection");
// let region = $('#region_id');
// let btnContainerMore = $("#btn-more-container");
// let city = $('#city_id');
// let cityOptions = $('#city_id option');
// let smsNumber = $('#smsInput');
// let regionIdChange;
// let category = $("#category_id");
// let inputsSelect = $(".inputs-selects");
// let cityContainer = $(".city-container");
// let categoriesClass = $(".categories");
// let phoneNumbersId = $("#phone-numbers");
// let inputNumberMask = $('.input-number-mask');
// let prefixInfoElement = $('.prefix-info');
// let numberInfoElement = $('.number-info');
// let categoryInfoElement = $('.category-info');
// let priceInfoElement = $('#price-info');
// let numberListElement = $('#numbers-list');
// let errorNotSelectedBookingElement = $("#error-not-selected-booking");
// let priceBookingElement = $("#price_booking");
// let fullNameElement = $("#full_name");
// let clientPhoneNumberElement = $("#client-phone-number");
// let valueDocIdElement = $("#valueDoc_id");
// let checkBoxElement = $("#check_box");
// let errorNotFilledBookingElement = $("#error-not-filled-booking");
// let checkBoxClassElement = $(".checkbox");
// let inputNotFilledClassElement = $(".input-not-filled");
// let typeDocIdElement = $('#typeDoc_id');
// let successPaymentElement = $("#success-payment");
// let paymeFormElement = $("#paymeForm");
// let forErrorModalPaymentCreate = $("#for-error-modal-payment-create");
// let paymeSMSFormElement = $("#payme-sms");
// let modalChoosingMethodElement = $("#modal-choosing-method");
// let headerPaymeElement = $("#header-payme");
// let headerPaymeTextElement = $(".header-payme-text");
// let clickuzSectionElement = $("#clickuzSection");
// let prefixContainer = $('.prefix-container');
// let prefixNumber = $('#prefix_id');
// let smsverify = {
//     "id": '',
//     "method": '',
//     "params": {
//         "token": '',
//         "code": ''
//     }
// };
// let duplicateIndicies = [];
// let star = '*';
// let regAFirst = '(?<A>[0-9])';
// let formData = {
//     "id": '',
//     "method": '',
//     "params": {
//         "card": {"number": '', "expire": ''},
//         "amount": '',
//         "save": ''
//     }
// };
// let city_selected = $('#city_id option:selected');
// let bookingSearchBtn = $('#bookingSearchBtn');
// let cityValue;

