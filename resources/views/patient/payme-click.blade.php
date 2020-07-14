<form class="choose">
    @csrf
    <div class="form-group">
        <label>Choose one of them</label>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-6">
            <img src="{{asset('img/payme_01.svg')}}" class="img-thumbnail choose-payme" style="margin: 22px" width="60%" height="60%">
        </div>
        <div class="col-md-6 col-sm-6">
            <img src="{{asset('img/click_01.jpg')}}" class="img-thumbnail choose-click" style="margin: 22px" width="60%" height="60%">
        </div>
    </div>
    <div class="error-container">
    </div>
</form>


{{-- payme --}}
<form class="payme">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Card number</label>
                <input type="text" id="p_card_number" name="card_number" class="form-control" placeholder="xxxx - xxxx - xxxx - xxxx">
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <img src="{{asset('img/payme_01.svg')}}" class="img-thumbnail" style="margin: 22px" width="40%" height="40%">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label>Expiration date</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" id="p_expire_month" name="expire_month" class="form-control" placeholder="MM">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" id="p_expire_year" name="expire_year" class="form-control" placeholder="Year">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <input class="btn_1 medium confirm-payme" type="submit" value="Confirm" style="margin: 22px">
        </div>
    </div>

    <div class="error-container">
    </div>

</form>
<form id="sms-payme" class="sms-payme">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Payme sms code <span id="countDown"></span></label>
                <input type="text" id="p_sms_code" name="sms_number" class="form-control" placeholder="xxxxxx">
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <input class="btn_1 medium pay-payme" type="submit" value="Pay" style="margin: 22px">
        </div>
    </div>
    <div class="error-container">
    </div>
</form>

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
