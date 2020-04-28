$(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
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
          ranges   : {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate  : moment()
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
      //Timepicker1
      $('#timepicker1').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
      })
      //Timepicker2
      $('#timepicker2').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
      })
      //Timepicker3
      $('#timepicker3 ').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
      })

    //Timepicker4
    $('#timepicker4').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    //Timepicker5
    $('#timepicker5').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    //Timepicker6
    $('#timepicker6').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    //Timepicker7
    $('#timepicker7 ').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })

    //Timepicker8
    $('#timepicker8').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    //Timepicker9
    $('#timepicker9').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    //Timepicker10
    $('#timepicker10').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    //Timepicker11
    $('#timepicker11 ').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })

    //Timepicker12
    $('#timepicker12').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    //Timepicker13
    $('#timepicker13').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    //Timepicker14
    $('#timepicker14').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    //Timepicker15
    $('#timepicker15 ').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    //Timepicker16
    $('#timepicker16').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
    //Timepicker17
    $('#timepicker17 ').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })

      //Bootstrap Duallistbox
      $('.duallistbox').bootstrapDualListbox()

      //Colorpicker
      $('.my-colorpicker1').colorpicker()
      //color picker with addon
      $('.my-colorpicker2').colorpicker()

      $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
      });

      $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      });

    })
