<div class="row">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('select[name="reg"]').on('change',function () {
                var reg_id=$(this).val();
                if(reg_id){
                   $.ajax({
                       url:'/findCity/'+reg_id,
                       type:'GET',
                       dataType:'json',
                       success:function (data) {
                           $('select[name="region"]').empty();
                           $.each(data,function (key,value) {
                               $('select[name="region"]').append('<option value="'+key+'">'+value+'</option>');
                           });
                       }
                   });
                }
                else{
                    $('select[name="region"]').empty();
                }
            });
        });

    </script>


    <div class="col-3">
        <div class="form-group">
            <select class="form-control" name="reg" id="reg">
                <option disabled selected>Выберете регион</option>
                @foreach($categories as $cat)

                    <option value="{{$cat->id}}">{{$cat->name_ru}}</option>

                @endforeach
            </select>
            <label>Родительский регион</label>
        </div>
    </div>


    <div class="col-3">
        <div class="form-group">
            <select class="form-control" name="region" id="reg">
                <option disabled selected>Выберете город</option>

            </select>
            <label>Родительский город</label>
        </div>
    </div>


    <div class="form-group col-3" align='center'>
        <input name="region_uz" type="text" class="form-control" placeholder="..."
               value="{{ old('region_uz')?? $districts->name_uz ??''}}">
        <label>Название района(узбекское)</label>
    </div>

    <div class="form-group col-3" align='center'>
        <input name="region_ru" type="text" class="form-control" placeholder="..."
               value="{{ old('region_ru')?? $districts->name_ru ??''}}">
        <label>Название района(русское)</label>
    </div>


</div>



{{--@foreach($categories as $cat)--}}
{{--    @foreach($cat->children($cat->id) as $item)--}}
{{--        <option value="{{$item->id}}">{{$item->name_ru}}</option>--}}
{{--    @endforeach--}}
{{--@endforeach--}}
