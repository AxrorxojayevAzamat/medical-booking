@extends('doctor.base')

@section('content')

<div class="content-wrapper">
		<div class="container-fluid" style="margin-top: 60px">
			@include('doctor.breadcrumbs')
			
            <div class="box_general padding_bottom">
			<div class="row">
			    <div class="col-12">
			        <div class="card primary">
			            <div class="card-body">
			                <div class="col-sm-12">
			                    <form method="POST" action="{{ route("doctor.store-specializations", $user) }}">
			                        @csrf
			                        <div class="row">
			                            <div class="col-sm-12">
			                                <div class="form-group">
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
			            <div class="card-footer">
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</div>
@endsection