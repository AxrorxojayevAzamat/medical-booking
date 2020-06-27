@extends('layouts.admin.page')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card primary">
            <div class="card-header">
                {{ __('Добавить специализации') }}
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <div class="col-sm-12">
                    <form method="POST" action="{{ route("admin.users.store-specializations", $user) }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">

                                    <label for="specialization" class="col-form-label text-md-left">{{ __('Специализации') }}</label>
                                    <select class="select2 select2-hidden-accessible" name="specializationUser[]" multiple="multiple" data-placeholder="{{ __('Специализации') }}" style="width: 100%;">
                                        <option value=""></option>

                                        @foreach($specializations as $id => $spec)
                                        <option value="{{ $id }}" {{ (in_array($id, old('specializations', [])) || isset($user) && $user->specializations()->pluck('id')->contains($id)) ? 'selected' : '' }}>{{ $spec }}</option>
                                        @endforeach

                                    </select>

                                    @error('specializationUser')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success float-left">{{ __('Обновить') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer -->

        </div>
        <!-- /.card primary-->
    </div>
    <!-- /.col-md -6.3 -->
</div>
<!-- /.row -->

@stop
