@extends('front.layout.layout')
@section('content')

<div class="main-content">
    <div class="container">
        <div class="news">
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

<div class="container">
    <div class="mitropolit">
        <a href="/mitropolit" class="mitropolit-card">
            <div class="image">
                <img src="{{ asset('front/images/'.$mitro->mitroimage) }}" alt="Слика није пронађена">
            </div>
            <div class="mitropolit-content">
                <div class="mitropolit-wrapper">
                    <div class="name">{{ $mitro->name }}</div>
                    <div class="text">{!! $mitro->mitrotext !!}</div>
                </div>
                <div class="show-more">
                    <div class="circle">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                    <p>Прочитај више</p>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d718.9649514998436!2d18.6083021468029!3d43.87945620155259!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x2d68d4cd0f17760b!2z0KXRgNCw0Lwg0KPRgdC_0LXRmtCwINCf0YDQtdGB0LLQtdGC0LUg0JHQvtCz0L7RgNC-0LTQuNGG0LU!5e0!3m2!1ssr!2sba!4v1662210741340!5m2!1ssr!2sba" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-a.com"></a><br><style>.mapouter{position:relative;;height:500px;width:100%;}</style><a href="https://www.embedgooglemap.net">how to embed google map in email</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style></div></div>

<div class="main-content">
    <div class="container">
        <div class="contact">
            <h3 class="section-title">Контакт</h3>
            <form action="{{ url('/') }}" method="post">@csrf
                <div class="form-group group1">
                    <input id="name" name="name" type="text" placeholder="Име и презиме" class="form-control">
                </div>
                <div class="form-group group2">
                    <input id="email" name="email" type="text" placeholder="Е-маил" class="form-control">
                </div>
                <div class="form-group group3">
                    <input id="theme" name="theme" type="text" placeholder="Тема" class="form-control">
                </div>
                <div class="form-group group4">
                    <input id="phone" name="phone" type="tel" placeholder="Број телефона">
                </div>
                <div class="form-group group5">
                    <textarea name="message" id="message" placeholder="Како вам можемо помоћи?"></textarea>
                </div>
                <button class="submit">Питај</button>
            </form>
        </div>
    </div>
</div>



@endsection