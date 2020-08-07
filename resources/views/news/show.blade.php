@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container margin_60">
        <div class="row">
            <div class="col-lg-9">
                <div class="bloglist singlepost">
                    <p><img alt="" class="img-fluid" src="{{ $news->image ? $news->imageDetailThumbnail : 'http://via.placeholder.com/800x400.jpg' }}"></p>
                    <h1>{{ $news->title }}</h1>
                    <div class="postmeta">
                        <ul>
                            <li><a href="#"><i class="icon_clock_alt"></i> {{ $news->created_at->format('d/m/Y') }}</a></li>
                            <li><a href="#"><i class="icon_pencil-edit"></i> {{ $news->createdBy->profile->fullName }}</a></li>
                        </ul>
                    </div>
                    <div class="post-content">
                        {!! $news->content !!}
{{--                        <div class="dropcaps">--}}
{{--                        </div>--}}
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection
