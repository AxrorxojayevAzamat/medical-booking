@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container margin_60">
        <div class="main_title">
            <h1>{{ trans('breadcrumbs.news') }}</h1>
        </div>
        <div class="row">
            <div class="col-lg-9">
                @foreach($news as $page)
                    <article class="blog wow fadeIn">
                        <div class="row no-gutters">
                            <div class="col-lg-7">
                                <figure>
                                    <a href="{{ route('news.show', $page) }}">
                                        <img src="{{ $page->image ? $page->imageListThumbnail : 'http://via.placeholder.com/800x533.jpg' }}" alt="">
                                        <div class="preview"><span>{{ trans('doctors.in_detail') }}</span></div>
                                    </a>
                                </figure>
                            </div>
                            <div class="col-lg-5">
                                <div class="post_info">
                                    <small>{{ $page->created_at->format('d M. Y') }}</small>
                                    <h3><a href="{{ route('news.show', $page) }}">{{ $page->title }}</a></h3>
                                    <p>{{ $page->description }}</p>
{{--                                    <ul>--}}
{{--                                        <li>--}}
{{--                                            <div class="thumb"><img src="http://via.placeholder.com/100x100.jpg" alt=""></div>{{ $page->createBy->profile->fullName }}--}}
{{--                                        </li>--}}
{{--                                        <li><i class="icon_comment_alt"></i> 20</li>--}}
{{--                                    </ul>--}}
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach

{{--                <nav aria-label="...">--}}
{{--                    <ul class="pagination pagination-sm">--}}
{{--                        <li class="page-item disabled">--}}
{{--                            <a class="page-link" href="#" tabindex="-1">Previous</a>--}}
{{--                        </li>--}}
{{--                        <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--                        <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                        <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                        <li class="page-item">--}}
{{--                            <a class="page-link" href="#">Next</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </nav>--}}
                {{ $news->links() }}
            </div>
        </div>
    </div>
@endsection
