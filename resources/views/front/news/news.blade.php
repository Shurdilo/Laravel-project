@extends('front.layout.layout')
@section('content')

<div class="main-content">
    <div class="container">
        <div class="news" id="news">
            @include('front.news.data')
        </div>
        <div class="ajax-load" style="display: none">
            <p><img src="{{ asset('front/images/Rolling-1.8s-200px.gif') }}" alt="Слика није пронађена"> Учитавање још вијести</p>
        </div>
    </div>
</div>

@endsection