@if (!config('adminlte.enabled_laravel_mix'))
    @php($javaScriptSectionName = 'js')
@else
    @php($javaScriptSectionName = 'mix_adminlte_js')
@endif

@section($javaScriptSectionName)
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
 

        $(document).ready(function () {
            $('#services').select2();

            let regions = $('#regions');
            
            $('#regions').on('change', 'select', function (e) {
                e.preventDefault();

                let region = $(this);
                let regionId = region.val();

                if (regionId) {
                    $.ajax({
                        url: '/api/regions/children/' + regionId,
                        method: "GET",
                        success: function (data) {
                            let depth = region.data('depth');
                            depth++;
                            clearRegions(depth);
                            let count = data.length;
                            if (count) {
                                let form = '<div class="form-group" id="form-group-' + depth + '">\n';
                                form += '   <label for="parentRegions" class="col-form-label">Родительский регион</label>\n';
                                form += "   <select id=\"parentRegions\" class=\"form-control parent-region{{ $errors->has('regions') ? ' is-invalid' : '' }}\" name=\"regions[]\" data-depth=\"" + depth + "\">\n";
                                form += '       <option value=""></option>\n';
                                for (let i = 0; i < count; i++) {
                                    form += '       <option value="' + data[i].id + '">' + data[i].name_ru + '</option>\n';
                                }
                                form += '   </select>\n';
                                form += '</div>\n';

                                regions.append(form);
                            }
                        },
                        error: function () {
                            console.log('error');
                        }
                    })
                }
            });

            function clearRegions(minId) {
                let region;
                while ((region = $('#form-group-' + minId)).length) {
                    region.remove();
                    minId++;
                }
            }
        })
    </script>
@endsection
