@if (!config('adminlte.enabled_laravel_mix'))
    @php($javaScriptSectionName = 'js')
@else
    @php($javaScriptSectionName = 'mix_adminlte_js')
@endif

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header"><h3 class="card-title">Названия</h3></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_uz" class="col-form-label">Название (узбекское)</label>
                            <input id="name_uz" class="form-control{{ $errors->has('name_uz') ? ' is-invalid' : '' }}" name="name_uz" value="{{ old('name_uz', $region ? $region->name_uz : null) }}" required>
                            @if ($errors->has('name_uz'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('name_uz') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_ru" class="col-form-label">Название (русское)</label>
                            <input id="name_ru" class="form-control{{ $errors->has('name_ru') ? ' is-invalid' : '' }}" name="name_ru" value="{{ old('name_ru', $region ? $region->name_ru : null) }}" required>
                            @if ($errors->has('name_ru'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('name_ru') }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-green card-outline">
            <div class="card-header"><h3 class="card-title">Родительский регион</h3></div>
            <div class="card-body" id="regions">
                <div class="form-group" id="form-group-1">
                    <label for="parents1" class="col-form-label">Родительский регион</label>
                    <select id="parents1" class="form-control parent-region{{ $errors->has('parents') ? ' is-invalid' : '' }}" name="parents[]" data-depth="1">
                        <option value=""></option>
                        @foreach ($parents as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach;
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

@section($javaScriptSectionName)
<script>
    let regions = $('#regions');

    $(document).ready(function () {
        $('select').change(function (e) {
            e.preventDefault();

            let region = $(this);
            let regionId = region.val();
            console.log(regionId);
            if (regionId) {
                $.ajax({
                    url: '/api/regions/children/' + regionId,
                    method: "GET",
                    success: function (data) {
                        let depth = region.data('depth');
                        depth++;
                        clearRegions(depth);
                        let count = data.length;
                        let form = '<div class="form-group" id="form-group-' + depth + '">';
                        form += '<label for="parents' + depth + '" class="col-form-label">Родительский регион</label>';
                        form += "<select id=\"parents" + depth + "\" class=\"form-control parent-region{{ $errors->has('parents') ? ' is-invalid' : '' }}\" name=\"parents[]\" data-depth=\"" + depth + "\">";
                        form += '<option value=""></option>';
                        for (let i = 0; i < count; i++) {
                            form += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                        }
                        form += '</select>';
                        form += '</div>';

                        regions.append(form);

                        console.log(data);
                    },
                    error: function () {
                        console.log('error');
                    }
                })
            }
        });

        function clearRegions(minId) {
            while (true) {
                let region = $('#form-group-' + minId);
                region.remove();
                if (region !== 0) {
                    break;
                }
                minId++;
            }
        }
    })
</script>
@endsection
