<div class="choose">
    <div class="form-group">
        <label>Choose one of them</label>
    </div>

    <div class="row">
        <form class="payme-choose col-md-6 col-sm-6">
        @csrf
            <label for="payme-submit">
                <img src="{{asset('img/payme_01.svg')}}" class="img-thumbnail choose-payme" style="margin: 22px" width="60%" height="60%">
                <input type="submit" value="" id="payme-submit">
            </label>
        </form>
        <form class="click-choose col-md-6 col-sm-6">
        @csrf
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

{{-- click --}}
<form class="click" >
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Card number</label>
                <input type="text" id="c_card_number" name="card_number" class="form-control" placeholder="xxxx - xxxx - xxxx - xxxx">
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <img src="{{asset('img/click_01.jpg')}}" class="img-thumbnail" style="margin: 22px" width="40%" height="40%">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label>Expiration date</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" id="c_expire_month" name="expire_month" class="form-control" placeholder="MM">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" id="c_expire_year" name="expire_year" class="form-control" placeholder="Year">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <input class="btn_1 medium confirm-click" type="submit" value="Confirm" style="margin: 22px">
        </div>
    </div>
    <div class="error-container">
    </div>
</form>

<form id="sms-click" class="sms-click">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Click sms code <span id="countDown"></span></label>
                <input type="text" id="sms_number" name="sms_number" class="form-control" placeholder="xxxxxx">
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <input class="btn_1 medium pay-clicks" type="submit" value="Pay" style="margin: 22px">
        </div>
    </div>
    <div class="error-container">
    </div>
</form>

<form class="successed">
    @csrf
    <div class="row">
        <h1>Successed !!!</h1>
    </div>
</form>
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
    clientInfo.booking_date = $('#booking_date').val();
    clientInfo.time_start = $('#time_start').val();
    clientInfo.description = "something";

    $.ajax({
        url: '/api/book/paycom/create',
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
</script>

@endsection
