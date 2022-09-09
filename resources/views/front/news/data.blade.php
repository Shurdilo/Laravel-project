@foreach($news as $new)
        <a href="/novosti/vijest/{{ $new->id }}" class="news-card">
            <div class="image">
                <img src="{{ asset('front/images/news/cover/'.$new->titleimage) }}" alt="Слика није пронађена">
            </div>
            <div class="news-content">
                <div class="news-wrapper">
                    <div class="news-title">{{ $new->title }}</div>
                    <div class="icons">
                        <div class="date">
                            <i class="fas fa-calendar-alt"></i>{{ $new->created_at->isoFormat('L') }}
                        </div>
                        <div class="admin">
                            <i class="fas fa-user"></i>{{ $new->name }}
                        </div>
                    </div>
                    <div class="news-text">{!! $new->newstext !!}</div>
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