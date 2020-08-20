<div class="choose">
    <div class="form-group">
        <label>{{ trans('book.choose_one_of_them') }}</label>
    </div>

    <div class="row d-flex justify-content-center">
        <form class="payme-choose col-md-5 col-sm-5 d-flex justify-content-center">
            <label for="payme-submit">
                <img src="{{asset('img/payme_01.svg')}}" class="img-payme-click choose-payme" width="200px" height=80px>
                <input type="submit" value="" id="payme-submit">
            </label>
        </form>
        <form class="click-choose col-md-5 col-sm-5 d-flex justify-content-center">
            <label for="click-submit">
                <img src="{{asset('img/click_01.jpg')}}" class="img-payme-click choose-click" width="200px" height="80px">
                <input type="submit" value="" id="click-submit">
            </label>
        </form>
    </div>
    <div class="error-container">
    </div>

</div>

    <input name="patient_id" type="hidden" value="{{$patient->id}}" id="patient_id"/>
    <input name="doctor_id" type="hidden" value="{{$doctor->id}}" id="doctor_id"/>
    <input name="clinic_id" type="hidden" value="{{$clinic->id}}" id="clinic_id"/>
    <input name="time_start" type="hidden" value="{{$radioTime}}" id="time_start"/>
    <input name="booking_date" type="hidden" value="{{$calendar}}" id="booking_date"/>
    <input name="merchant_id" type="hidden" value="5f07150278994c390463280c" id="payme_merchant_id"/>

@include('patient.payme')

@include('patient._click')

@section('scripts')
@include('patient.payme-js')
@include('patient.click_script')

<script>
    $('.click').css('display','none');
    $('.sms-click').css('display','none');
    $('.successed').css('display','none');


    $('.click').css('display','none');
    $('.sms-click').css('display','none');

    $('#payme-submit').hide();
    $('#click-submit').hide();
    $('input[name="booking_date"]').hide();
    $('#click-submit').hide();
    $('input[name="booking_date"]').hide();

    $('.click-choose').submit(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-Auth': $('#payme_merchant_id').val()
            }
        });
        let orderCreate = {};
        var bookAr = $("#booking_date").val().split("/");
        var bookTime = bookAr[2] + "-" + bookAr[0] + "-" + bookAr[1]
        orderCreate.doctor_id = $('#doctor_id').val();
        orderCreate.clinic_id = $('#clinic_id').val();
        orderCreate.amount = 15000;
        orderCreate.booking_date = bookTime;
        orderCreate.time_start = $('#time_start').val();
        orderCreate.description = $('#description').val();


        $.ajax({
            url: '/book/click/create',
            method: "POST",
            data: orderCreate,
            dataType: "json",
            success: function (data) {
                console.log(data);
                clickOrderId = data.data.transaction_id;
                console.log(clickOrderId);
                $('.choose').hide();
                $('.click').css('display','block');
            },
            error: function (data) {
                console.log(data);
                $('.choose').show();
                $('.click').css('display','none');
                $(".error-container").text(data.message);
            }
        })


    });
</script>

@endsection
