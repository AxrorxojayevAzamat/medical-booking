@if (!config('adminlte.enabled_laravel_mix'))
@php($javaScriptSectionName = 'js')
@else
@php($javaScriptSectionName = 'mix_adminlte_js')
@endif

@section($javaScriptSectionName)
<script>

//////////// for adminCallCenter findDoctorByCity
    $(document).ready(function () {
        $('#region').on('change', function () {
            let region_id = $(this).val();
            $.ajax({
                url: '/api/call-center/findDoctorByRegion/?',
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
                url: '/api/call-center/findDoctorByType/?',
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
                url: '/api/call-center/findDoctorByType/?',
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
</script>
@endsection
