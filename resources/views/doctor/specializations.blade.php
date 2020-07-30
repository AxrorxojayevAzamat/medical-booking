@extends('doctor.base')

@section('content')

<div class="content-wrapper">
        <div class="container-fluid" style="margin-top: 60px">
            <div class="box_general padding_bottom">
            	<h1 align="center">{{trans('menu.editSpecialization')}}</h1>
			<div class="row">
			    <div class="col-md-6">
			        <div class="card primary">
			            <div class="card-header">
			                {{ __('Добавить специализации') }}
			            </div>
			            <!-- /.card-header -->
			            <div class="card-body">
			                <div class="col-sm-12">
			                    <form method="POST" action="{{ route("doctor.store-specializations", $user) }}">
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

		</div>
	</div>
</div>
<script src="{{URL::to('vendor/select2/js/select2.full.min.js')}}"></script>
<script src="{{URL::to('vendor/select2/css/select2.min.css')}}"></script>
<script src="{{URL::to('vendor/bootstrap-fileinput/js/fileinput.min.js')}}"></script>
<script src="{{URL::to('assets/vendor/bootstrap-fileinput/js/plugins/piexif.js')}}"></script>
<link rel="stylesheet" href="{{URL::to('vendor/bootstrap-fileinput/css/fileinput-rtl.css')}}">
<script src="{{URL::to('vendor/bootstrap-fileinput/js/plugins/sortable.js')}}"></script>
<script src="{{URL::to('vendor/bootstrap-fileinput/js/plugins/purify.js')}}"></script>
<script src="{{URL::to('vendor/bootstrap-fileinput/js/locales/ru.js')}}"></script>
<script src="{{URL::to('vendor/bootstrap-fileinput/themes/fas/theme.js')}}"></script>
@endsection