<script>
    let timetable = @json($doctorTimetables);
            let books = @json($doctorBooks);
            let holidays = @json($holidays);
    console.log(timetable);
    console.log(books);
    console.log(holidays);



    var timeStart = [];
    var timeEnd = [];
    var time_slots = [[], []];

    var disabledDates = [[], []];
    var disabledDays = [[], []];
    var disDays = [[], []];

    function getDates(index) {
        var d = new Date();
        var year = d.getFullYear();
        var month = d.getMonth() + 1;
        var i;
        if (timetable[index].odd_start == null && timetable[index].odd_end == null) {
            i = 1;
            while (i < 30) {
                i = i + 2;
                disDays[index] = [...disDays[index], year + '-' + month + '-' + i, year + '-' + (month + 1) + '-' + i];
            }
        } else if (timetable[index].even_start == null && timetable[index].even_end == null) {
            i = 0;
            while (i < 30) {
                i = i + 2;
                disDays[index] = [...disDays[index], year + '-' + month + '-' + i, year + '-' + (month + 1) + '-' + i];
            }
        } else {
            disDays[index] = [];
        }
        return disDays[index];
    }

    function setTimes(selected_day, index) {
        var day;
        if (timetable[index].schedule_type == 1) {
            day = selected_day.getDay();

            timeStart[index] = [day == 0 ? timetable[index].sunday_start || '' :
                        day == 1 ? timetable[index].monday_start || '' :
                        day == 2 ? timetable[index].tuesday_start || '' :
                        day == 3 ? timetable[index].wednesday_start || '' :
                        day == 4 ? timetable[index].thursday_start || '' :
                        day == 5 ? timetable[index].friday_start || '' :
                        day == 6 ? timetable[index].saturday_start || '' : null];

            timeEnd[index] = [day == 0 ? timetable[index].sunday_end || '' :
                        day == 1 ? timetable[index].monday_end || '' :
                        day == 2 ? timetable[index].tuesday_end || '' :
                        day == 3 ? timetable[index].wednesday_end || '' :
                        day == 4 ? timetable[index].thursday_end || '' :
                        day == 5 ? timetable[index].friday_end || '' :
                        day == 6 ? timetable[index].saturday_end || '' : null];
            //  console.log(timeStart[index]);
            //  console.log(timeEnd[index]);
        } else {
            day = selected_day.getDate();

            timeStart[index] = [day % 2 != 0 ? timetable[index].odd_start || '' :
                        day % 2 == 0 ? timetable[index].even_start || '' : null];

            timeEnd[index] = [day % 2 != 0 ? timetable[index].odd_end || '' :
                        day % 2 == 0 ? timetable[index].even_end || '' : null];
            //  console.log(timeStart[index]);
            //  console.log(timeEnd[index]);
        }
    }

    function makeInterval(day, time_start, time_end, interval, lunch_start, lunch_end, index) {
        var timeStart = new Date(day + " " + time_start);
        var timeEnd = new Date(day + " " + time_end);
        time_slots[index] = [];
        if (lunch_start && lunch_end) {
            var lunchStart = new Date(day + " " + lunch_start);
            var lunchEnd = new Date(day + " " + lunch_end);
            while (timeStart < lunchStart) {
                time_slots[index] = [...time_slots[index], (timeStart.getHours() < 10 ? '0' + timeStart.getHours() : timeStart.getHours()) + ":" +
                            (timeStart.getMinutes() < 10 ? '0' + timeStart.getMinutes() : timeStart.getMinutes())];
                timeStart.setMinutes(timeStart.getMinutes() + interval);
            }
            while (lunchEnd < timeEnd) {
                time_slots[index] = [...time_slots[index], (lunchEnd.getHours() < 10 ? '0' + lunchEnd.getHours() : lunchEnd.getHours()) + ":" +
                            (lunchEnd.getMinutes() < 10 ? '0' + lunchEnd.getMinutes() : lunchEnd.getMinutes())];
                lunchEnd.setMinutes(lunchEnd.getMinutes() + interval);
            }
        } else {
            while (timeStart < timeEnd) {
                time_slots[index] = [...time_slots[index], (timeStart.getHours() < 10 ? '0' + timeStart.getHours() : timeStart.getHours()) + ":" +
                            (timeStart.getMinutes() < 10 ? '0' + timeStart.getMinutes() : timeStart.getMinutes())];
                timeStart.setMinutes(timeStart.getMinutes() + interval);
            }
        }
        // console.log(time_slots[index]);
    }

    function appendRadioButton(time_slot, book, day, index) {
        var equeled;
        $("#radio_times" + index).empty();
        for (var i = 0; i < time_slot[index].length; i++) {
            equeled = true;
            for (var j = 0; j < book.length; j++) {
                if ((time_slot[index][i] == book[j].time_start.slice(0, 5)) && (day == book[j].booking_date) && (timetable[index].clinic_id == book[j].clinic_id)) {
                    equeled = false;
                    $("#radio_times" + index).append(
                            '<li><input type="radio" id="radio' + index + '-' + i + '" name="radio_time" value="' +
                            time_slot[index][i] + '"><label style="color: #ccc; text-decoration: line-through;">' + time_slot[index][i] + '</label></li>'
                            );
                    break;
                }
            }
            if (equeled)
                $("#radio_times" + index).append(
                        '<li><input type="radio" id="radio' + index + '-' + i + '" name="radio_time" value="' +
                        time_slot[index][i] + '"><label for="radio' + index + '-' + i + '">' + time_slot[index][i] + '</label></li>'
                        )
        }
    }

    // timetable[1].tuesday_start = null;
    // timetable[1].tuesday_end = null;

    for (var i = 0; i < timetable.length; i++) {

        disabledDates[i] = timetable[i].schedule_type == 2 ? getDates(i) : [];
        disabledDays[i] = timetable[i].schedule_type == 1 ? [timetable[i].sunday_start == null ? 0 : '',
            timetable[i].monday_start == null ? 1 : '',
            timetable[i].tuesday_start == null ? 2 : '',
            timetable[i].wednesday_start == null ? 3 : '',
            timetable[i].thursday_start == null ? 4 : '',
            timetable[i].friday_start == null ? 5 : '',
            timetable[i].saturday_start == null ? 6 : ''] : [];

        $('#calendar' + i).datepicker({
            todayHighlight: true,
            daysOfWeekDisabled: disabledDays[i],
            weekStart: 1,
            format: "yyyy-mm-dd",
            datesDisabled: disabledDates[i].concat(holidays),
        }).on('changeDate', function (e) {
            $('#my_hidden_input' + e.currentTarget.id.slice(-1)).val(e.format());
            setTimes((new Date(e.format())), e.currentTarget.id.slice(-1));
            makeInterval(e.format(), timeStart[e.currentTarget.id.slice(-1)], timeEnd[e.currentTarget.id.slice(-1)],
                    timetable[e.currentTarget.id.slice(-1)].interval, timetable[e.currentTarget.id.slice(-1)].lunch_start,
                    timetable[e.currentTarget.id.slice(-1)].lunch_end, e.currentTarget.id.slice(-1));
            appendRadioButton(time_slots, books, e.format(), e.currentTarget.id.slice(-1));
        });
    }
    $(document).ready(function () {
        var d = new Date();
        var today = d.getFullYear() + "-" + d.getMonth() + "-" + d.getDate();
        for (var i = 0; i < timetable.length; i++) {
            setTimes(d, i);
            makeInterval(today, timeStart[i], timeEnd[i], timetable[i].interval,
                    timetable[i].lunch_start, timetable[i].lunch_end, i);
            appendRadioButton(time_slots, books, today, i);
            if (time_slots[i][0] == "00:00") {
                $("#radio_times" + i).empty();
            }
        }
    });

</script>

