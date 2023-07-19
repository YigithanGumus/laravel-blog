@extends('front.layouts.master')
@section('title', 'Anasayfa')
@section('content')
    <div class="row">
        <div class="col-md-8">
            @include('front.widgets.articleList')
        </div>
            @include('front.widgets.categoryWidget')
    </div>
@endsection
