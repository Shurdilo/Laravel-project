@extends('front.layout.layout')
@section('content')

<div class="container">
    <div class="parohije">
        <a class="parohije-card" href="parohije/parohija/1">
            <h1>I</h1>
            <p>парохија мокрањска</p>
        </a>
        <a class="parohije-card" href="parohije/parohija/2">
            <h1>II</h1>
            <p>парохија мокрањска</p>
        </a>
    </div>
</div>

<div class="main-content">
    <div class="container">
        <div class="latestnews">
            <h3 class="section-title">Недавне новости</h3>
            <div class="row">
                @foreach ($news as $new)
                    <a href="/novosti/vijest/{{ $new->id }}" class="news-card">
                        <div class="image">
                            <img src="{{ asset('front/images/news/cover/'.$new->titleimage) }}" alt="Слика није пронађена">
                        </div>
                        <div class="news-content">
                            <div class="news-wrapper">
                                <h3 class="news-title">{{ $new->title }}</h3>
                                <div class="news-text">{!! $new->newstext !!}</div>
                                <div class="date"><i class="fas fa-calendar-alt"></i>{{ $new->created_at->isoFormat('L') }}</div>
                            </div>
                            <div class="show-more">
                                <div class="circle">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                                <p>Прочитај више</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection