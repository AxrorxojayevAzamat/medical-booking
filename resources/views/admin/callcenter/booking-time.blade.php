@extends('adminlte::page')

@section('content')

<div class="tab-content">
    <div class="tab-pane fade show active" id="book" role="tabpanel" aria-labelledby="book-tab">
        <p class="lead add_bottom_30">{{ __('Расписание доктора') }} </p>
        <form method="GET" action="{{ route('admin.callcenter.booking', [$user1, $clinic1]) }}" >
            <div class="main_title_3">
                <h3><strong>1</strong>{{ __('Выберите вашу дату') }}</h3>
            </div>
            <div class="form-group add_bottom_45">
                <div id="calendar"></div>
                <input type="hidden" id="my_hidden_input">
                <ul class="legend">
                    <li><strong></strong>{{ __('Доступный') }}</li>
                    <li><strong></strong>{{ __('Недоступен') }}</li>
                </ul>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="calendar2" class="col-form-label">{{ __('TestCalendar') }}</label>
                    <select class="form-control" id="calendar2" name="calendar2">
                        <option></option>
                        @foreach ($daysOn as $value)
                        <option value="{{ $value }}"{{ $value === $currentDate ? ' selected' : '' }}>{{ $value }}</option>
                        @endforeach;
                    </select>
                    <label></label>
                </div>
            </div>      
            <div class="main_title_3">
                <h3><strong>2</strong>{{ __('Выберите') }}</h3>
            </div>
            <div class="row justify-content-center add_bottom_45">
                <div class="col-md-12">
                    <ul class="time_select">
                        @foreach ($reseptionTimes as $value => $label)
                        <li>
                            <input type="radio" id="radio{{$value}}" name="radio_time" value="{{$label}}">
                            <label for="radio{{$value}}">{{$label}}</label>
                        </li>                                            
                        @endforeach

                    </ul>
                </div>

            </div>
            <!-- /row -->

            <div class="main_title_3">
                <h3><strong>3</strong>{{ __('Выберите услугу') }}</h3>
            </div>
            <ul class="treatments clearfix">
                <li>
                    <div class="checkbox">
                        <input type="checkbox" class="css-checkbox" id="visit1" name="visit1">
                        <label for="visit1" class="css-label">{{ __('Визит боли в спине') }} <strong>$55</strong></label>
                    </div>
                </li>
                <li>
                    <div class="checkbox">
                        <input type="checkbox" class="css-checkbox" id="visit2" name="visit2">
                        <label for="visit2" class="css-label">{{ __('Сердечно-сосудистый экран') }}<strong>$55</strong></label>
                    </div>
                </li>

            </ul>


            <hr>
            <p class="text-center"><button class="btn_1 medium" type="submit">{{ __('Забронируйте сейчас') }}</button></p>
        </form>					
    </div>
    <!-- /tab_1 -->
</div>
<!-- /tab-content -->
@stop
@section('js')
<script>
    let period = @json($daysOff);
            console.log(period);

    let reseptionTimes = @json($reseptionTimes);
    console.log(reseptionTimes);


    $('#calendar').datepicker({
        todayHighlight: true,
        daysOfWeekDisabled: [],
        weekStart: 1,
        format: "yyyy-mm-dd",
        datesDisabled: period,
    });



</script>
@stop
