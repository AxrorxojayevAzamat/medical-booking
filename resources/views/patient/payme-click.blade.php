<div class="choose">
    <div class="form-group">
        <label>Choose one of them</label>
    </div>

    <div class="row">
        <form class="payme-choose col-md-6 col-sm-6">
            <label for="payme-submit">
                <img src="{{asset('img/payme_01.svg')}}" class="img-thumbnail choose-payme" style="margin: 22px" width="60%" height="60%">
                <input type="submit" value="" id="payme-submit">
            </label>
        </form>
        <form class="click-choose col-md-6 col-sm-6">
            <label for="click-submit">
                <img src="{{asset('img/click_01.jpg')}}" class="img-thumbnail choose-click" style="margin: 22px" width="60%" height="60%">
                <input type="submit" value="" id="click-submit">
            </label>
        </form>
    </div>
    <div class="error-container">
    </div>

</div>

    <input name="patient_id" type="hidden" value="{{$patient->id}}" id="patient_id"/>
    <input name="doctor_id" type="hidden" value="{{$user->id}}" id="doctor_id"/>
    <input name="clinic_id" type="hidden" value="{{$clinic->id}}" id="clinic_id"/>
    <input name="time_start" type="hidden" value="{{$radioTime}}" id="time_start"/>
    <input name="booking_date" type="hidden" value="{{$calendar}}" id="booking_date"/>
    <input name="merchant_id" type="hidden" value="5f07150278994c390463280c" id="payme_merchant_id"/>

@include('patient.payme')

<div class="click-container">
    @include('patient.click')
</div>

@section('scripts')
<script>
    $('.payme').css('display','none');
    $('.click').css('display','none');
    $('.sms-payme').css('display','none');
    $('.sms-click').css('display','none');
    $('.successed').css('display','none');

    $('#payme-submit').hide();
    $('#click-submit').hide();
    $('input[name="booking_date"]').hide();


// $('.choose').on("submit", function() {
//     infoSendPaymeUz();
// })
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

    clientInfo.doctor_id = $('#doctor_id').val();
    clientInfo.clinic_id = $('#clinic_id').val();
    clientInfo.amount = 15000;
    clientInfo.booking_date = '2020-07-15';
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
})

// $('.payme-choose').submit(function(e) {
//     e.preventDefault();
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
//             'XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
//             'X-Auth': $('#payme_merchant_id').val()
//         }
//     });
//     let orderCreate = {};
//     orderCreate.doctor_id = $('#doctor_id').val();
//     orderCreate.clinic_id = $('#clinic_id').val();
//     orderCreate.amount = 15000;
//     orderCreate.booking_date = '2020-07-15';
//     orderCreate.time_start = $('#time_start').val();
//     orderCreate.description = "click order create";
//
//
//     $.ajax({
//         url: '/book/click/create',
//         method: "POST",
//         data: orderCreate,
//         dataType: "json",
//         success: function (data) {
//             console.log("success");
//             paymeOrderId = data.data.order_id;
//             $('.choose').hide();
//             $('.click-container').show();
//         },
//         error: function (data) {
//             console.log(data);
//             $('.payme').hide();
//             $('.choose').css('display','block');
//             $(".error-container").val(data.message);
//         }
//     })
//
//
// });
</script>

@endsection
