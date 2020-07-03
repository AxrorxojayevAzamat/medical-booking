<div class="container">
    <div class="row">
      <div class="col">
   
        <div class="radio">
            <label>
                <input type="radio" name="schedule_type" id="schedule_type1" value="1" {{old ('schedule_type',  $timetable && $timetable->schedule_type == '1' ? "checked" : "" )}}>
                Неделя
            </label>
        </div>
            
      
        <div class="bootstrap-timepicker">
            <div class="form-group">
                <label>Понедельник</label>

                <div class="input-group date" id="timepicker" data-target-input="nearest">
                    <input type="time" name="monday_start" class="form-control datetimepicker-input" data-target="#timepicker" value="{{ old('monday_start', $timetable ? $timetable->monday_start :'')}}">
                    <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                    </div>
                </div>

                <div class="input-group date" id="timepicker1" data-target-input="nearest">
                    <input type="time" name="monday_end" class="form-control datetimepicker-input" data-target="#timepicker1" value= "{{ old('monday_end',$timetable ? $timetable->monday_end :'')}}">
                    <div class="input-group-append" data-target="#timepicker1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bootstrap-timepicker">
            <div class="form-group">
                <label>Вторник</label>

                <div class="input-group date" id="timepicker2" data-target-input="nearest">
                    <input type="time" name="tuesday_start" class="form-control datetimepicker-input" data-target="#timepicker2" value="{{ old('tuesday_start',$timetable ? $timetable->tuesday_start :'')}}">
                    <div class="input-group-append" data-target="#timepicker2" data-toggle="datetimepicker">
                        <div class="input-group-text">
                            <i class="far fa-clock"></i>
                        </div>
                    </div>
                </div>
                <div class="input-group date" id="timepicker3" data-target-input="nearest">
                    <input type="time" name="tuesday_end" class="form-control datetimepicker-input" data-target="#timepicker3" value="{{ old('tuesday_end',$timetable ? $timetable->tuesday_end:'')}}">
                    <div class="input-group-append" data-target="#timepicker3" data-toggle="datetimepicker">
                        <div class="input-group-text">
                            <i class="far fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bootstrap-timepicker">
            <div class="form-group">
                <label>Среда</label>

                <div class="input-group date" id="timepicker4" data-target-input="nearest">
                    <input type="time" name="wednesday_start" class="form-control datetimepicker-input" data-target="#timepicker4" value="{{ old('wednesday_start', $timetable ? $timetable->wednesday_start:'')}}">
                    <div class="input-group-append" data-target="#timepicker4" data-toggle="datetimepicker">
                        <div class="input-group-text">
                            <i class="far fa-clock"></i>
                        </div>
                    </div>
                </div>
                <div class="input-group date" id="timepicker5" data-target-input="nearest">
                    <input type="time" name="wednesday_end" class="form-control datetimepicker-input" data-target="#timepicker5" value="{{ old('wednesday_end', $timetable ? $timetable->wednesday_end :'')}}">
                    <div class="input-group-append" data-target="#timepicker5" data-toggle="datetimepicker">
                        <div class="input-group-text">
                            <i class="far fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bootstrap-timepicker">
            <div class="form-group">
                <label>Четверг</label>

                <div class="input-group date" id="timepicker6" data-target-input="nearest">
                    <input type="time" name="thursday_start" class="form-control datetimepicker-input" data-target="#timepicker6" value="{{ old('thursday_start', $timetable ? $timetable->thursday_start :'')}}">
                    <div class="input-group-append" data-target="#timepicker6" data-toggle="datetimepicker">
                        <div class="input-group-text">
                            <i class="far fa-clock"></i>
                        </div>
                    </div>
                </div>
                <div class="input-group date" id="timepicker7" data-target-input="nearest">
                    <input type="time" name="thursday_end" class="form-control datetimepicker-input" data-target="#timepicker7" value="{{ old('thursday_end', $timetable ? $timetable->thursday_end :'')}}">
                    <div class="input-group-append" data-target="#timepicker7" data-toggle="datetimepicker">
                        <div class="input-group-text">
                            <i class="far fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bootstrap-timepicker">
            <div class="form-group">
                <label>Пятница</label>

                <div class="input-group date" id="timepicker8" data-target-input="nearest">
                    <input type="time" name="friday_start" class="form-control datetimepicker-input" data-target="#timepicker8" value="{{ old('friday_start',$timetable ? $timetable->friday_start :'')}}">
                    <div class="input-group-append" data-target="#timepicker8" data-toggle="datetimepicker">
                        <div class="input-group-text">
                            <i class="far fa-clock"></i>
                        </div>
                    </div>
                </div>
                <div class="input-group date" id="timepicker9" data-target-input="nearest">
                    <input type="time" name="friday_end" class="form-control datetimepicker-input" data-target="#timepicker9" value="{{ old('friday_end', $timetable ? $timetable->friday_end:'')}}">
                    <div class="input-group-append" data-target="#timepicker9" data-toggle="datetimepicker">
                        <div class="input-group-text">
                            <i class="far fa-clock"></i>
                        </div>
                    </div>
                </div>
               
            </div>
            
        </div>
        <div class="bootstrap-timepicker">
            <div class="form-group">
                <label>Суббота</label>

                <div class="input-group date" id="timepicker10" data-target-input="nearest">
                    <input type="time" name="saturday_start" class="form-control datetimepicker-input" data-target="#timepicker10" value="{{ old('saturday_start', $timetable ? $timetable->saturday_start :'')}}">
                    <div class="input-group-append" data-target="#timepicker10" data-toggle="datetimepicker">
                        <div class="input-group-text">
                            <i class="far fa-clock"></i>
                        </div>
                    </div>
                </div>
                <div class="input-group date" id="timepicker11" data-target-input="nearest">
                    <input type="time" name="saturday_end" class="form-control datetimepicker-input" data-target="#timepicker11" value="{{ old('saturday_end',$timetable ?  $timetable->saturday_end :'')}}">
                    <div class="input-group-append" data-target="#timepicker11" data-toggle="datetimepicker">
                        <div class="input-group-text">
                            <i class="far fa-clock"></i>
                        </div>
                    </div>
                </div>
               
            </div>
           
        </div>

        <div class="bootstrap-timepicker">
            <div class="form-group">
                <label>Воскресенье</label>

                <div class="input-group date" id="timepicker12" data-target-input="nearest">
                    <input type="time" name="sunday_start" class="form-control datetimepicker-input" data-target="#timepicker12" value="{{ old('sunday_start',$timetable ? $timetable->sunday_start :'')}}">
                    <div class="input-group-append" data-target="#timepicker12" data-toggle="datetimepicker">
                        <div class="input-group-text">
                            <i class="far fa-clock"></i>
                        </div>
                    </div>
                </div>
                <div class="input-group date" id="timepicker13" data-target-input="nearest">
                    <input type="time" name="sunday_end" class="form-control datetimepicker-input" data-target="#timepicker13" value="{{ old('sunday_end',$timetable ? $timetable->sunday_end :'')}}">
                    <div class="input-group-append" data-target="#timepicker13" data-toggle="datetimepicker">
                        <div class="input-group-text">
                            <i class="far fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      
      
      
       <div class="col">
                <div class="radio">
                    <label>
                        <input type="radio" name="schedule_type" id="schedule_type1" value="2" {{old ('schedule_type',  $timetable && $timetable->schedule_type == '2' ? "checked" : "" )}}>
                        Месяц - четные и нечетные дни
                    </label>
                </div>

            <div class="bootstrap-timepicker">
                <div class="form-group">
                    <label>Начало и конец рабочего дня для четных дней</label>

                    <div class="input-group date" id="timepicker14" data-target-input="nearest">
                        <input type="time" name="even_start" class="form-control datetimepicker-input" data-target="#timepicker14" value="{{ old('even_start')}}">
                        <div class="input-group-append" data-target="#timepicker14" data-toggle="datetimepicker">
                            <div class="input-group-text">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-group date" id="timepicker15" data-target-input="nearest">
                        <input type="time" name="even_end" class="form-control datetimepicker-input" data-target="#timepicker15" value="{{ old('even_end')}}">
                        <div class="input-group-append" data-target="#timepicker15" data-toggle="datetimepicker">
                            <div class="input-group-text">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bootstrap-timepicker">
                <div class="form-group">
                    <label>Начало и конец рабочего дня для нечетных дней</label>

                    <div class="input-group date" id="timepicker16" data-target-input="nearest">
                        <input type="time" name="odd_start" class="form-control datetimepicker-input" data-target="#timepicker16" value="{{ old('odd_start', $timetable? $timetable->odd_start :'')}}">
                        <div class="input-group-append" data-target="#timepicker16" data-toggle="datetimepicker">
                            <div class="input-group-text">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-group date" id="timepicker17" data-target-input="nearest">
                        <input type="time" name="odd_end" class="form-control datetimepicker-input" data-target="#timepicker17" value="{{ old('odd_end', $timetable ? $timetable->odd_end :'')}}">
                        <div class="input-group-append" data-target="#timepicker17" data-toggle="datetimepicker">
                            <div class="input-group-text">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bootstrap-timepicker">
                <div class="form-group">
                    <label>Интервал</label>
                    <div class="input-group date" id="timepicker18" data-target-input="nearest">
                        <input type="number" name="interval" class="form-control datetimepicker-input" data-target="#timepicker" value="{{ old('interval',$timetable ? $timetable->interval : '')}}">

                    </div>
                </div>
            </div>
            <br><br><br>
            <div class="bootstrap-timepicker">
                <div class="form-group">
                    <label>Обеденный перерыв начало и конец</label>

                    <div class="input-group date" id="timepicker19" data-target-input="nearest">
                        <input type="time" name="lunch_start" class="form-control datetimepicker-input" data-target="#timepicker16" value="{{ old('lunch_start',$timetable ? $timetable->lunch_start :'')}}">
                        <div class="input-group-append" data-target="#timepicker19" data-toggle="datetimepicker">
                            <div class="input-group-text">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-group date" id="timepicker20" data-target-input="nearest">
                        <input type="time" name="lunch_end" class="form-control datetimepicker-input" data-target="#timepicker17" value="{{ old('lunch_end', $timetable ? $timetable->lunch_end :'')}}">
                        <div class="input-group-append" data-target="#timepicker20" data-toggle="datetimepicker">
                            <div class="input-group-text">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br>
            <div class="form-group col">
                <div class="form-group">
                    <label>Отпуск или нерабочие дни начало:</label>
                    <input name="day_off_start" type="date" class="form-control" value="{{ old('day_off_start',$timetable ? $timetable->day_off_start :'')}}" >
                </div>
            </div>
            <div class="form-group col">
                <div class="form-group">
                    <label>Отпуск или нерабочие дни конец:</label>
                    <input name="day_off_end" type="date" class="form-control" value="{{ old('day_off_end', $timetable ? $timetable->day_off_end :'')}}" >
                </div>
            </div>
            <input type="submit" value="Отправить"  class="btn btn-primary float-right">
        </div>
    </div>
    