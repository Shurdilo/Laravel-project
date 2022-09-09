@extends('front.layout.layout')
@section('content')

<div class="main-content">
    <div class="container mitro-container">
        <div class="mitropolit">
            <h1 class="section-title">{{ $mitro->name }}</h1>
            <div class="mitropolit-wrapper">
                <div class="image">
                    <img src="{{ asset('front/images/'.$mitro->mitroimage) }}" alt="Слика није пронађена">
                </div>
                <p>{!! $mitro->mitrotext !!}</p>
            </div>
        </div>
    </div>
</div>

@endsection