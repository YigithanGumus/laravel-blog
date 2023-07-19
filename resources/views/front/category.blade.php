@extends('front.layouts.master')
@section('title', $category->name.' Kategorisi |'.count($articles).' yazı bulundu.')
@section('content')
    <div class="col-md-9  col-xl-7">

        @include('front.widgets.categoryTextWidget')

    </div>
    @include('front.widgets.categoryWidget')
@endsection
