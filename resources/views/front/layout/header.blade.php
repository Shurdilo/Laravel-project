<header>
    <div class="container">
        <div class="site-header">
            <a href="/" class="logo">
                <img src="{{ asset('universal/images/logo.png') }}" alt="Слика није пронађена">
                <h1 class="logotext">Српска православна црквена</br> општина мокро у мокром</h1>
            </a>
            <nav>
                <ul>
                    <li @if($page == "index") class="active" @endif><a href="/">Почетна</a></li>
                    <li @if($page == "novosti") class="active" @endif><a href="/novosti">Новости</a></li>
                    <li @if($page == "bogosluzenja") class="active" @endif><a href="/bogosluzenja">Богослужења</a></li>
                    <li @if($page == "parohije") class="active" @endif><a href="/parohije">Парохије</a></li>
                    <li @if($page == "galerija") class="active" @endif><a href="/galerija">Галерија</a></li>
                    <li @if($page == "ljetopis") class="active" @endif><a href="/ljetopis">Љетопис</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>


<div class="hero" style="background:url('{{ url('/front/images/hero/'.$heroImage) }}');">
    {!! $heroText !!}
</div>