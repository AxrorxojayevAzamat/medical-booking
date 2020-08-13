@extends('layouts.app')
@section('breadcrumbs', '')
@section('content')
<main>
    <div id="error_page">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-xl-7 col-lg-9">
                    <h2><i class="icon_error-triangle_alt"></i></h2>
                    <p>{{ trans('msg.404') }}</p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection