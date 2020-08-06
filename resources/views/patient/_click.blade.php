<div class="click" >

    <div class="row  d-flex justify-content-center">
        <div class="col-md-7 col-11">
            <div class="form-group">
                <label>{{trans('msg.card_num')}}</label>
                <input type="text" id="c_card_number" name="card_number" class="form-control" placeholder="xxxx - xxxx - xxxx - xxxx">
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-md-4 col-6">
            <label>{{trans('msg.expire_date')}}</label>
            <div class="row">
                <div class="col-md-6 col-6">
                    <div class="form-group">
                        <input type="text" id="c_expire_month" name="expire_month" class="form-control" placeholder="MM">
                    </div>
                </div>
                <div class="col-md-6 col-6">
                    <div class="form-group">
                        <input type="text" id="c_expire_year" name="expire_year" class="form-control" placeholder="Year">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-5">
            <div class="row d-flex justify-content-end">
                <img src="{{asset('img/click_01.jpg')}}" class="img-thumbnail" style="margin: 21px 15px" width="75%" height="75%">
            </div>
        </div>
    </div>
    <p class="row d-flex justify-content-center m-0">Нажимая кнопку "Продолжить"</p>

    <div class="row d-flex justify-content-center">
        <div class="col-md-6 d-flex justify-content-center">
            <input class="btn_1 medium confirm-click" id="tokenCreate" type="submit" value="{{trans('msg.next')}}" style="margin: 22px">
        </div>
    </div>
    <div class="error-container">
    </div>
</div>

<form id="sms-click" class="sms-click">

    <div class="row">
        <div class="col-md-6">
            <div class="timer" id="timerclickuz"></div>
            <div class="form-group">
                <label>{{trans('msg.sms_code')}}<span id="countDown"></span></label>
                <input type="text" id="sms_number" name="sms_number" class="form-control" placeholder="xxxxxx">
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <input class="btn_1 medium pay-clicks" id="sms-sent-btn-click" type="submit" value="Pay" style="margin: 22px">
        </div>
    </div>
    <div class="error-container">
    </div>
</form>

<div class="successed">

</div>
