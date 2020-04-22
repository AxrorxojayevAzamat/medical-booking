@extends('adminlte::page')
@section('content')



{{--
<button type="button" class="btn btn-primary" name="off_day" data-toggle="modal" data-target="#exampleModal3" data-whatever="@fat">Отпуск</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Неделя</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td>
                            <h6 align='center'>ПН</h6>
                        </td>
                        <td>
                            <input type="time" name="monday_start">
                        </td>
                        <td>
                            <input type="time" name="monday_end">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6 align='center'>ВТ</h6>
                        </td>
                        <td>
                            <input type="time" name="tuesday_start">
                        </td>
                        <td>
                            <input type="time" name="tuesday_end">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6 align='center'>СР</h6>
                        </td>
                        <td>
                            <input type="time" name="wednesday_start">
                        </td>
                        <td>
                            <input type="time" name="wednesday_end">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6 align='center'>ЧТ</h6>
                        </td>
                        <td>
                            <input type="time" name="thursday_start">
                        </td>
                        <td>
                            <input type="time" name="thursday_end">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6 align='center'>ПТ</h6>
                        </td>
                        <td>
                            <input type="time" name="friday_start">
                        </td>
                        <td>
                            <input type="time" name="friday_end">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6 align='center'>СБ</h6>
                        </td>
                        <td>
                            <input type="time" name="saturday_start">
                        </td>
                        <td>
                            <input type="time" name="saturday_end">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6 align='center'>ВС</h6>
                        </td>
                        <td>
                            <input type="time" name="sunday_start">
                        </td>
                        <td>
                            <input type="time" name="sunday_end">
                        </td>
                    </tr>
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label>Time picker:</label>

                            <div class="input-group date" id="timepicker" data-target-input="nearest">
                                <input type="time" class="form-control datetimepicker-input" data-target="#timepicker">
                                <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                </div>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>
                </table>

                <div>
                    Интервал <input type="number" name="interval">
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary">Отправить</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Месяц</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="radio">
                        <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                            Четные дни месяца
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                            Нечетные дни месяца
                        </label>
                    </div>

                </div>
                <div class = "time">

                    <input type="time" name="odd_start"> Начало рабочего дня
                    <br>
                    <input type="time" name="odd_end"> Конец рабочего дня
                </div>
                <div class = "time">

                    <input type="time" name="even_start"> Начало рабочего дня
                    <br>
                    <input type="time" name="even_end"> Конец рабочего дня

                    <div>
                        Интервал<input type="number" name="interval">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary">Отправить</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Отпуск</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div>
                    <p>
                        <label for="date">Введите начало отпуска </label>
                        <input type="date" id="date" name="day_off_start"/>
                    </p>
                    <p>
                        <label for="date">Введите конец отпуска   </label>
                        <input type="date" id="date" name="day_off_end"/>
                    </p>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary">ОТправить</button>
            </div>
        </div>
    </div>
</div>
--}}
<style>
    .block-left{width:50%;height:800px;overflow:auto;float:left;}
    .block-right{width:50%;height:800px;overflow:auto;}
    .btn-primary :active{background-color: #000c19}
</style>


<div class="block-left">
    <div class="icheck-primary d-inline">
        <input type="checkbox" id="checkboxPrimary2">
        <label for="checkboxPrimary2">
        Неделя
        </label>
    </div>

        <div class="bootstrap-timepicker">
            <div class="form-group">
                <label>Понедельник</label>

                <div class="input-group date" id="timepicker" data-target-input="nearest">
                        <input type="time" class="form-control datetimepicker-input" data-target="#timepicker">
                    <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                        <div class="input-group-text">
                            <i class="far fa-clock"></i>
                        </div>
                    </div>
                </div>
                <div class="input-group date" id="timepicker" data-target-input="nearest">
                    <input type="time" class="form-control datetimepicker-input" data-target="#timepicker">
                    <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
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

            <div class="input-group date" id="timepicker" data-target-input="nearest">
                <input type="time" class="form-control datetimepicker-input" data-target="#timepicker">
                <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                    <div class="input-group-text">
                        <i class="far fa-clock"></i>
                    </div>
                </div>
            </div>
            <div class="input-group date" id="timepicker" data-target-input="nearest">
                <input type="time" class="form-control datetimepicker-input" data-target="#timepicker">
                <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
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

            <div class="input-group date" id="timepicker" data-target-input="nearest">
                <input type="time" class="form-control datetimepicker-input" data-target="#timepicker">
                <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                    <div class="input-group-text">
                        <i class="far fa-clock"></i>
                    </div>
                </div>
            </div>
            <div class="input-group date" id="timepicker" data-target-input="nearest">
                <input type="time" class="form-control datetimepicker-input" data-target="#timepicker">
                <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
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

            <div class="input-group date" id="timepicker" data-target-input="nearest">
                <input type="time" class="form-control datetimepicker-input" data-target="#timepicker">
                <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                    <div class="input-group-text">
                        <i class="far fa-clock"></i>
                    </div>
                </div>
            </div>
            <div class="input-group date" id="timepicker" data-target-input="nearest">
                <input type="time" class="form-control datetimepicker-input" data-target="#timepicker">
                <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
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

            <div class="input-group date" id="timepicker" data-target-input="nearest">
                <input type="time" class="form-control datetimepicker-input" data-target="#timepicker">
                <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                    <div class="input-group-text">
                        <i class="far fa-clock"></i>
                    </div>
                </div>
            </div>
            <div class="input-group date" id="timepicker" data-target-input="nearest">
                <input type="time" class="form-control datetimepicker-input" data-target="#timepicker">
                <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
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

            <div class="input-group date" id="timepicker" data-target-input="nearest">
                <input type="time" class="form-control datetimepicker-input" data-target="#timepicker">
                <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                    <div class="input-group-text">
                        <i class="far fa-clock"></i>
                    </div>
                </div>
            </div>
            <div class="input-group date" id="timepicker" data-target-input="nearest">
                <input type="time" class="form-control datetimepicker-input" data-target="#timepicker">
                <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
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

            <div class="input-group date" id="timepicker" data-target-input="nearest">
                <input type="time" class="form-control datetimepicker-input" data-target="#timepicker">
                <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                    <div class="input-group-text">
                        <i class="far fa-clock"></i>
                    </div>
                </div>
            </div>
            <div class="input-group date" id="timepicker" data-target-input="nearest">
                <input type="time" class="form-control datetimepicker-input" data-target="#timepicker">
                <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
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
    <div class="icheck-primary d-inline">
        <input type="checkbox" id="checkboxPrimary2">
        <label for="checkboxPrimary2">
            Месяц
        </label>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <div class="radio">
                <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                    Четные дни месяца
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                    Нечетные дни месяца
                </label>
            </div>

        </div>
        <div class="bootstrap-timepicker">
            <div class="form-group">
                <label>Начало и конец рабочего дня</label>

                <div class="input-group date" id="timepicker" data-target-input="nearest">
                    <input type="time" class="form-control datetimepicker-input" data-target="#timepicker">
                    <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                        <div class="input-group-text">
                            <i class="far fa-clock"></i>
                        </div>
                    </div>
                </div>
                <div class="input-group date" id="timepicker" data-target-input="nearest">
                    <input type="time" class="form-control datetimepicker-input" data-target="#timepicker">
                    <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
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
                <input type="number" class="form-control datetimepicker-input" data-target="#timepicker">

            </div>
            <!-- /.input group -->
        </div>
        <!-- /.form group -->
    </div>

        <div class="form-group">
            <label>Введите отпуск:</label>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                </div>
                <input type="text" class="form-control float-right" id="reservationtime">
            </div>
            <!-- /.input group -->
        </div>
    <br><br><br><br><br><br><br>
    <button type="button" class="btn btn-primary">Отправить</button>
</div>

@endsection
