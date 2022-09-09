@extends('front.layout.layout')
@section('content')

<div class="container">
    <div class="post">
        <div class="title">{{ $new->title }}</div>
        <div class="news">
            <div class="title-image">
                <img src="{{ asset('front/images/news/cover/'.$new->titleimage) }}" alt="Слика није пронађена">
            </div>
            <div class="news-attachments">
                <div class="date"><i class="fas fa-calendar-alt"></i> {{ $new->created_at->isoFormat('L') }}</div>
                <div class="admin"><i class="fas fa-user"></i> {{ $new->name }}</div>
            </div>
            <div class="news-text">
                {!! $new->newstext !!}
            </div>
        </div>
        @if(count($images) > 0)
        <div class="images">
            @foreach($images as $image)
            @if ($loop->first)
                <a href="{{ asset('front/images/news/images/'.$image->newsimage) }}" data-lightbox="{{ $new->titleimage }}" data-title="{{ $new->title }}">
                    <h1><i class="fas fa-images"></i> Галерија</h1>
                    <img src="{{ asset('front/images/news/images/'.$image->newsimage) }}" alt="Слика није пронађена">
                </a>
            @else
                <a href="{{ asset('front/images/news/images/'.$image->newsimage) }}" data-lightbox="{{ $new->titleimage }}" data-title="{{ $new->title }}" hidden>
                    <img src="{{ asset('front/images/news/images/'.$image->newsimage) }}" alt="Слика није пронађена">
                </a>
            @endif
            @endforeach
        </div>
        @endif
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

<script src="{{ url('front/js/lightbox.js') }}"></script>
<script>
    lightbox.option({
      'resizeDuration': 350
    })
</script>
@endsection