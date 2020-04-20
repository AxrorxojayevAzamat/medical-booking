@extends('adminlte::page')
@section('content')



<button type="button" class="btn btn-primary" name="scheduleType" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Неделя</button>
<button type="button" class="btn btn-primary" name="scheduleType" data-toggle="modal" data-target="#exampleModal2" data-whatever="@fat">Мецяц</button>

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
                            <h6 align='center'>ВТ</h6>
                        </td>
                        <td>
                            <h6 align='center'>СР</h6>
                        </td>
                        <td>
                            <h6 align='center'>ЧТ</h6>
                        </td>
                        <td>
                            <h6 align='center'>ПТ</h6>
                        </td>
                        <td>
                            <h6 align='center'>СБ</h6>
                        </td>
                        <td>
                            <h6 align='center'>ВС</h6>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <input type="time" name="monday_start">
                            <br>
                            <input type="time" name="monday_end">
                        </td>
                        <td>
                            <input type="time" name="tuesday_start">
                            <br>
                            <input type="time" name="tuesday_end">
                        </td>
                        <td>
                            <input type="time" name="wednesday_start">
                            <br>
                            <input type="time" name="wednesday_end">
                        </td>
                        <td>
                            <input type="time" name="thursday_start">
                            <br>
                            <input type="time" name="thursday_end">
                        </td> <td>
                            <input type="time" name="friday_start">
                            <br>
                            <input type="time" name="friday_end">
                        </td>
                        <td>
                            <input type="time" name="saturday_start">
                            <br>
                            <input type="time" name="saturday_end">
                        </td><td>
                            <input type="time" name="sunday_start">
                            <br>
                            <input type="time" name="sunday_end">
                        </td>

                    </tr>

                </table>

                <div>
                    <input type="number" name="interval">
                </div>

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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Неделя</h5>
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
                </div>
                <div>

                    <div>
                        <input type="number" name="interval">
                    </div>
                    <p>
                        <label for="date">Введите начало отпуска </label>
                        <input  type="date" id="date" name="day_off_start"/>
                    </p>
                    <p>
                        <label for="date">Введите конец отпуска   </label>
                        <input type="date" id="date" name="day_off_end"/>
                    </p>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>

{{--
</body>
</html> --}}

@endsection
