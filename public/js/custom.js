$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

    $(document).ready(function () {
        bsCustomFileInput.init();
    });

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'MM/DD/YYYY hh:mm A'
        }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function (start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
    )

    //Timetable
    $('#timepicker1').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    $('#timepicker2').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    $('#timepicker3').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    $('#timepicker4').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    $('#timepicker5').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    $('#timepicker6').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    $('#timepicker7').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    $('#timepicker8').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    $('#timepicker9').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    $('#timepicker10').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    $('#timepicker11').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    $('#timepicker12').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    $('#timepicker13').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    $('#timepicker14').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    $('#timepicker15').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    $('#timepicker16').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    $('#timepicker17').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    $('#timepicker18').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    $('#timepicker').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
//Timetable

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()
    //Timepicker
    $('#timepicker').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })

    $(document).ready(function () {
        bsCustomFileInput.init();
    });

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'MM/DD/YYYY hh:mm A'
        }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function (start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function (event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function () {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

})

//////////// for adding region
$(document).ready(function () {
    $('select[name="reg"]').on('change', function () {
        let region_id = $(this).val();
        if (region_id) {
            $.ajax({
                url: '/region/findCity/' + region_id,
                type: 'GET',
                dataType: 'json',

                success: function (data) {
                    $('select[name="region"]').empty();
                    $.each(data, function (key, value) {
                        $('select[name="region"]').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        } else {
            $('select[name="region"]').empty();
        }
    });
});
//////////// for adding region


//////////// for adminCallCenter findDoctorByCity
$(document).ready(function () {
    $('#region').on('change', function () {
        let region_id = $(this).val();
        $.ajax({
            url: 'callcenter/findDoctorByRegion/?',
            type: 'GET',
            data: {
                region: region_id
            },
            dataType: 'json',

            success: function (data) {
                console.log(data)
                $('#city').empty();
                $('#city').append('<option></option>');
                $.each(data.cities, function (key, value) {
                    $('#city').append('<option value="' + key + '">' + value + '</option>');
                });

                $('#clinic').empty();
                $('#clinic').append('<option></option>');
                $.each(data.clinics, function (key, value) {
                    $('#clinic').append('<option value="' + key + '">' + value + '</option>');
                });
            }
        });
    });
});

//////////// for adminCallCenter findDoctor
$(document).ready(function () {
    $('#city').on('change', function () {
        let region_id = $('#region').val();
        let type_id = $('#type').val();
        let city_id = $('#city').val();
        $.ajax({
            url: 'callcenter/findDoctorByType/?',
            type: 'GET',
            data: {
                region: region_id,
                type: type_id,
                city: city_id
            },
            dataType: 'json',

            success: function (data) {
                $('#clinic').empty();
                $('#clinic').append('<option></option>');
                $.each(data, function (key, value) {
                    $('#clinic').append('<option value="' + key + '">' + value + '</option>');
                });
            }
        });

    });
});

//////////// for adminCallCenter findDoctor
$(document).ready(function () {
    $('#type').on('change', function () {
        let region_id = $('#region').val();
        let type_id = $(this).val();
        let city_id = $('#city').val();
        $.ajax({
            url: 'callcenter/findDoctorByType/?',
            type: 'GET',
            data: {
                region: region_id,
                type: type_id,
                city: city_id
            },
            dataType: 'json',

            success: function (data) {
                $('#clinic').empty();
                $('#clinic').append('<option></option>');
                $.each(data, function (key, value) {
                    $('#clinic').append('<option value="' + key + '">' + value + '</option>');
                });
            }
        });

    });
});
//////////// for adminCallCenter bookingDoctor
$(document).ready(function () {
    $('#calendar2').on('change', function () {
        let booking_date = $(this).val();
        $.ajax({
            url: 'callcenter/bookingDoctor/?',
            type: 'GET',
            data: {
                region: booking_date,
            },
            dataType: 'json',

            success: function (data) {
                $('#calendar2').empty();
                $('#calendar2').append('<option></option>');
                $.each(data, function (key, value) {
                    $('#calendar2').append('<option value="' + key + '">' + value + '</option>');
                });
            }
        });

    });
});

///////////  for validation time
//Time  range picker
$('#timepickerstart').datetimepicker({
    use24hours: true,
    format: 'HH:mm'
})

$('#timepickerend').datetimepicker({
    use24hours: true,
    format: 'HH:mm'
})

///////////  for validation time
//Time  range picker
$('#timepickerstart').datetimepicker({
    use24hours: true,
    format: 'HH:mm'
})

$('#timepickerend').datetimepicker({
    use24hours: true,
    format: 'HH:mm'
})
///////////  for validation time


// $(document).ready(function() {
//   var url1 = 'http://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg',
//       url2 = 'http://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Earth_Eastern_Hemisphere.jpg/600px-Earth_Eastern_Hemisphere.jpg';
//   $("#input-24").fileinput({
//       initialPreview: [url1, url2],
//       initialPreviewAsData: true,
//       initialPreviewConfig: [
//           {caption: "Moon.jpg", downloadUrl: url1, size: 930321, width: "120px", key: 1},
//           {caption: "Earth.jpg", downloadUrl: url2, size: 1218822, width: "120px", key: 2}
//       ],
//       deleteUrl: "/site/file-delete",
//       overwriteInitial: false,
//       maxFileSize: 100,
//       initialCaption: "The Moon and the Earth"
//   });
// });
