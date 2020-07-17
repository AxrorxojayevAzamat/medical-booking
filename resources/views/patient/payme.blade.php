<form class="payme">
    @csrf
    <div class="row d-flex justify-content-center">
        <div class="col-md-5">
            <div class="form-group">
                <label>Card number</label>
                <input type="text" id="p_card_number" name="card_number" class="form-control" placeholder="xxxx - xxxx - xxxx - xxxx">
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <img src="{{asset('img/payme_01.svg')}}" class="img-thumbnail" style="margin: 22px" width="60%" height="60%">
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-md-5">
            <label>Expiration date</label>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" id="p_expire_month" name="expire_month" class="form-control" placeholder="MM">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" id="p_expire_year" name="expire_year" class="form-control" placeholder="Year">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <input class="btn_1 medium confirm-payme" type="submit" value="Confirm" style="margin: 22px 0">
        </div>
    </div>
    {{-- <div class="row container-fluid">
            <input class="btn_1 medium cancel-payme" type="submit" value="Cancel" style="margin: 22px 20px">
    </div> --}}

    <div class="error-container">
    </div>

</form>
<form id="sms-payme" class="sms-payme">
    @csrf
    <div class="row d-flex justify-content-center">
        <div class="col-md-5">
            <div class="form-group">
                <label>Payme sms code <span id="countDown"></span></label>
                <input type="text" id="p_sms_code" name="sms_number" class="form-control" placeholder="xxxxxx">
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <input class="btn_1 medium pay-payme" type="submit" value="Pay" style="margin: 22px">
        </div>
    </div>
    <div class="error-container">
    </div>
</form>
<div class="success container"></div>
