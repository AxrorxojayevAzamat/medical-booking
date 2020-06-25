@extends('layouts.admin.page')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card primary">
            <div class="card-header">
                {{ __('Добавить клинику') }}
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <div class="col-sm-12">
                    <form method="POST" action="{{ route("admin.users.store-clinics", $user) }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">

                                    <label for="clinic" class="col-form-label text-md-left">{{ __('Клиники') }}</label>
                                    <select class="select2 select2-hidden-accessible" name="clinicUser[]" multiple="multiple" data-placeholder="{{ __('Клиники') }}" style="width: 100%;">
                                        <option value=""></option>

                                        @foreach($clinics as $id => $clinic)
                                        <option value="{{ $id }}" {{ (in_array($id, old('clinics', [])) || isset($user) && $user->clinics()->pluck('id')->contains($id)) ? 'selected' : '' }}>{{ $clinic }}</option>
                                        @endforeach

                                    </select>


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
