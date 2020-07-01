@extends('layouts.admin.page')
@section('content')
    <style>
        .block-left {
            width: 50%;
            height: 800px;
            overflow: auto;
            float: left;
        }

        .block-right {
            width: 50%;
            height: 800px;
            overflow: auto;
        }
    </style>

    <form action="{{route('admin.timetables.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="block-left">
            <div class="radio">
                <label>
                    <input type="radio" name="scheduleType" id="scheduleType1" value="2">
                    Неделя
                </label>
            </div>

            <div class="bootstrap-timepicker">
                <div class="form-group">
                    <label>Понедельник</label>

                    <div class="input-group date" id="timepicker1" data-target-input="nearest">
                        <input type="time" name="monday_start" class="form-control datetimepicker-input"
                               data-target="#timepicker1">
                        <div class="input-group-append" data-target="#timepicker1" data-toggle="datetimepicker">
                            <div class="input-group-text">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-group date" id="timepicker2" data-target-input="nearest">
                        <input type="time" name="monday_end" class="form-control datetimepicker-input"
                               data-target="#timepicker2">
                        <div class="input-group-append" data-target="#timepicker2" data-toggle="datetimepicker">
                            <div class="input-group-text">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
            </div>

            <div class="bootstrap-timepicker">
                <div class="form-group">
                    <label>Вторник</label>

                    <div class="input-group date" id="timepicker3" data-target-input="nearest">
                        <input type="time" name="tuesday_start" class="form-control datetimepicker-input"
                               data-target="#timepicker3">
                        <div class="input-group-append" data-target="#timepicker3" data-toggle="datetimepicker">
                            <div class="input-group-text">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-group date" id="timepicker4" data-target-input="nearest">
                        <input type="time" name="tuesday_end" class="form-control datetimepicker-input"
                               data-target="#timepicker4">
                        <div class="input-group-append" data-target="#timepicker4" data-toggle="datetimepicker">
                            <div class="input-group-text">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
            </div>
            <div class="bootstrap-timepicker">
                <div class="form-group">
                    <label>Среда</label>

                    <div class="input-group date" id="timepicker5" data-target-input="nearest">
                        <input type="time" name="wednesday_start" class="form-control datetimepicker-input"
                               data-target="#timepicker5">
                        <div class="input-group-append" data-target="#timepicker5" data-toggle="datetimepicker">
                            <div class="input-group-text">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-group date" id="timepicker6" data-target-input="nearest">
                        <input type="time" name="wednesday_end" class="form-control datetimepicker-input"
                               data-target="#timepicker6">
                        <div class="input-group-append" data-target="#timepicker6" data-toggle="datetimepicker">
                            <div class="input-group-text">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
            </div>

            <div class="bootstrap-timepicker">
                <div class="form-group">
                    <label>Четверг</label>

                    <div class="input-group date" id="timepicker7" data-target-input="nearest">
                        <input type="time" name="thursday_start" class="form-control datetimepicker-input"
                               data-target="#timepicker7">
                        <div class="input-group-append" data-target="#timepicker7" data-toggle="datetimepicker">
                            <div class="input-group-text">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-group date" id="timepicker8" data-target-input="nearest">
                        <input type="time" name="thursday_end" class="form-control datetimepicker-input"
                               data-target="#timepicker8">
                        <div class="input-group-append" data-target="#timepicker8" data-toggle="datetimepicker">
                            <div class="input-group-text">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
            </div>
            <div class="bootstrap-timepicker">
                <div class="form-group">
                    <label>Пятница</label>

                    <div class="input-group date" id="timepicker9" data-target-input="nearest">
                        <input type="time" name="friday_start" class="form-control datetimepicker-input"
                               data-target="#timepicker9">
                        <div class="input-group-append" data-target="#timepicker9" data-toggle="datetimepicker">
                            <div class="input-group-text">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-group date" id="timepicker10" data-target-input="nearest">
                        <input type="time" name="friday_end" class="form-control datetimepicker-input"
                               data-target="#timepicker10">
                        <div class="input-group-append" data-target="#timepicker10" data-toggle="datetimepicker">
                            <div class="input-group-text">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
            </div>
            <div class="bootstrap-timepicker">
                <div class="form-group">
                    <label>Суббота</label>

                    <div class="input-group date" id="timepicker11" data-target-input="nearest">
                        <input type="time" name="saturday_start" class="form-control datetimepicker-input"
                               data-target="#timepicker11">
                        <div class="input-group-append" data-target="#timepicker11" data-toggle="datetimepicker">
                            <div class="input-group-text">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-group date" id="timepicker12" data-target-input="nearest">
                        <input type="time" name="saturday_end" class="form-control datetimepicker-input"
                               data-target="#timepicker12">
                        <div class="input-group-append" data-target="#timepicker12" data-toggle="datetimepicker">
                            <div class="input-group-text">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
            </div>

            <div class="bootstrap-timepicker">
                <div class="form-group">
                    <label>Воскресенье</label>

                    <div class="input-group date" id="timepicker13" data-target-input="nearest">
                        <input type="time" name="sunday_start" class="form-control datetimepicker-input"
                               data-target="#timepicker13">
                        <div class="input-group-append" data-target="#timepicker13" data-toggle="datetimepicker">
                            <div class="input-group-text">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-group date" id="timepicker14" data-target-input="nearest">
                        <input type="time" name="sunday_end" class="form-control datetimepicker-input"
                               data-target="#timepicker14">
                        <div class="input-group-append" data-target="#timepicker14" data-toggle="datetimepicker">
                            <div class="input-group-text">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
            </div>
        </div>

        <div class="block-right">
            <div class="modal-body">
                <div class="form-group">
                    <div class="radio">
                        <label>
                            <input type="radio" name="scheduleType" id="scheduleType2" value="2">
                            Месяц - четные дни
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="scheduleType" id="scheduleType3" value="3">
                            Месяц - нечетные дни
                        </label>
                    </div>

                </div>
                <div class="bootstrap-timepicker">
                    <div class="form-group">
                        <label>Начало и конец рабочего дня для четных дней</label>

                        <div class="input-group date" id="timepicker15" data-target-input="nearest">
                            <input type="time" name="even_start" class="form-control datetimepicker-input"
                                   data-target="#timepicker15">
                            <div class="input-group-append" data-target="#timepicker15" data-toggle="datetimepicker">
                                <div class="input-group-text">
                                    <i class="far fa-clock"></i>
                                </div>
                            </div>
                        </div>
                        <div class="input-group date" id="timepicker16" data-target-input="nearest">
                            <input type="time" name="even_end" class="form-control datetimepicker-input"
                                   data-target="#timepicker16">
                            <div class="input-group-append" data-target="#timepicker16" data-toggle="datetimepicker">
                                <div class="input-group-text">
                                    <i class="far fa-clock"></i>
                                </div>
                            </div>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                </div>
                <div class="bootstrap-timepicker">
                    <div class="form-group">
                        <label>Начало и конец рабочего дня для нечетных дней</label>

                        <div class="input-group date" id="timepicker17" data-target-input="nearest">
                            <input type="time" name="odd_start" class="form-control datetimepicker-input"
                                   data-target="#timepicker17">
                            <div class="input-group-append" data-target="#timepicker17" data-toggle="datetimepicker">
                                <div class="input-group-text">
                                    <i class="far fa-clock"></i>
                                </div>
                            </div>
                        </div>
                        <div class="input-group date" id="timepicker18" data-target-input="nearest">
                            <input type="time" name="odd_end" class="form-control datetimepicker-input"
                                   data-target="#timepicker18">
                            <div class="input-group-append" data-target="#timepicker18" data-toggle="datetimepicker">
                                <div class="input-group-text">
                                    <i class="far fa-clock"></i>
                                </div>
                            </div>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                </div>
                <div class="bootstrap-timepicker">
                    <div class="form-group">
                        <label>Интервал</label>

                        <div class="input-group date" id="timepicker" data-target-input="nearest">
                            <input type="number" name="interval" class="form-control datetimepicker-input"
                                   data-target="#timepicker">

                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                </div>

                <div class="form-group col-5" align='center'>
                    <div class="form-group">
                        <input name="day_off_start" type="date" class="form-control" value="{{ old('date')?? $celebrations->date ??''}}" >
                        <label>Введите начало отпуска:</label>
                    </div>
                </div>
                <div class="form-group col-5" align='center'>
                    <div class="form-group">
                        <input name="day_off_end" type="date" class="form-control" value="{{ old('date')?? $celebrations->date ??''}}" >
                        <label>Введите конец отпуска:</label>
                    </div>
                </div>
                <br><br><br><br>
                <input type="submit" value="Отправить"  class="btn btn-primary">
            </div>
        </div>
    </form>
@endsection
