@extends('front.layouts.master')
@section('title', $article->title)
@section('bg', $article->image)
@section('content')
    <div class="col-md-8" style="margin-bottom: 30px;">
        {!! $article->content !!}
    </div>
    @include('front.widgets.categoryWidget')
@endsection
