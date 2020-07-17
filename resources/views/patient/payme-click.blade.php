<div class="choose">
    <div class="form-group">
        <label>Choose one of them</label>
    </div>

    <div class="row">
        <form class="payme-choose col-md-6 col-sm-6 d-flex justify-content-end">
            <label for="payme-submit">
                <img src="{{asset('img/payme_01.svg')}}" class="img-payme-click choose-payme" width="200px" height=80px>
                <input type="submit" value="" id="payme-submit">
            </label>
        </form>
        <form class="click-choose col-md-6 col-sm-6 d-flex justify-content-start">
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
@include('patient.payme-js')

<script>
    $('.click').css('display','none');
    $('.sms-click').css('display','none');
    $('.successed').css('display','none');

    $('#click-submit').hide();
    $('input[name="booking_date"]').hide();

</script>

@endsection
