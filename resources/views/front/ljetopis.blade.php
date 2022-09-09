@extends('front.layout.layout')
@section('content')

<div class="main-content">
    <div class="container">
        <div class="ljetopis">
            <h1 class="section-title">Љетопис храма Успења Пресвете Богородице у Мокром</h1>
            <div class="ljetopis-wrapper">
                <p>{!! $ljetopis->ljetopistext !!}</p>
            </div>
        </div>
    </div>
</div>

@endsection