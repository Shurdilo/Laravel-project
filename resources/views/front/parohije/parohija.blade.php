@extends('front.layout.layout')
@section('content')

<div class="main-content">
    <div class="container">
        <div class="parohija">
            <div class="details">
                <div class="image">
                    <img src="{{ asset('front/images/parohije/'.$parohija->paroh_image) }}" alt="Слика није пронађена">
                </div>
                <div class="informations">
                    <div class="info">
                        {{-- <i class="fas fa-map-marker-alt"></i> --}}
                        <i class="fas fa-map-signs"></i>
                        <div class="info-card">
                            <p class="info-text">{{ $parohija->name }}</p>
                            <p class="info-subtext">Назив парохије</p>
                        </div>
                    </div>
                    <div class="info">
                        <i class="fas fa-user"></i>
                        <div class="info-card">
                            <p class="info-text">{{ $parohija->paroh }}</p>
                            <p class="info-subtext">Име и презиме пароха</p>
                        </div>
                    </div>
                    <div class="info">
                        <i class="fas fa-phone"></i>
                        <div class="info-card">
                            <a class="info-text" href="tel:{{ $parohija->paroh_phone }}">{{ $parohija->paroh_phone }}</a>
                            <p class="info-subtext">Мобилни број</p>
                        </div>
                    </div>
                    <div class="info">
                        <i class="fas fa-envelope"></i>
                        <div class="info-card">
                            <a class="info-text" href="mailto:{{ $parohija->paroh_email }}">{{ $parohija->paroh_email }}</a>
                            <p class="info-subtext">Е-маил</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="about">{!! $parohija->about !!}</div>
        </div>
    </div>
</div>

@endsection