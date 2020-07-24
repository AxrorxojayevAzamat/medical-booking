<form class="payme">
    @csrf
<p class="row d-flex justify-content-center">{{trans('msg.payme_msg_1')}}<span style="color: #fff">a</span> <span style="background: #e74e84;
        height: 20px;
        width: 16px;
        text-align: center;
        border-radius: 50%;
        color: #fff;">?</span></p>
    <div class="row d-flex justify-content-center">
        <div class="col-md-7 col-sm-7 col-11">
            <div class="form-group">
                <label>{{trans('msg.card_num')}}</label>
                <input type="text" id="p_card_number" name="card_number" class="form-control" placeholder="xxxx - xxxx - xxxx - xxxx">
            </div>
        </div>

    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-md-4 col-sm-4 col-6">
            <label>{{trans('msg.expire_date')}}</label>
            <div class="row">
                <div class="col-md-6 col-sm-6  col-6">
                    <div class="form-group">
                        <input type="text" id="p_expire_month" name="expire_month" class="form-control" placeholder="MM">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6  col-6">
                    <div class="form-group">
                        <input type="text" id="p_expire_year" name="expire_year" class="form-control" placeholder="Year">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 col-5">
            <div class="row d-flex justify-content-end">
                <img src="{{asset('img/payme_01.svg')}}" class="img-thumbnail" style="margin: 24px 15px" width="75%" height="75%">
            </div>
        </div>
    </div>

    <p class="row d-flex justify-content-center m-0">{{trans('msg.payme_msg_2')}}<span style="color: #fff">a</span><a href="https://cdn.payme.uz/terms/main.html"> {{trans('msg.payme_msg_3')}}</a></p>

    <div class="row d-flex justify-content-center">
        <div class="col-md-4 col-sm-4 d-flex justify-content-center">
            <input class="btn_1 medium confirm-payme" type="submit" value="{{trans('msg.next')}}" style="margin: 22px 0">
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
            <label>{{trans('msg.sms_code')}}<span id="countDown"></span></label>
                <input type="text" id="p_sms_code" name="sms_number" class="form-control" placeholder="xxxxxx">
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
        <input class="btn_1 medium pay-payme" type="submit" value="{{trans('msg.next')}}" style="margin: 22px">
        </div>
    </div>
    <div class="error-container">
    </div>
</form>
<div class="success container"></div>
