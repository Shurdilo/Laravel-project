<div class="footer">
    <div class="container">
        <div class="footer-head">
            <a href="/" class="logo">
                <img src="{{ asset('universal/images/logo.png') }}" alt="Слика није пронађена">
                <h1 class="logotext">Српска православна црквена</br> општина мокро у мокром</h1>
            </a>
            <div class="social-networks">
                <a href="#">@include('front.facebook')</a>
                <a href="#">@include('front.instagram')</a>
            </div>
        </div>
        <div class="footer-main">
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
            <div class="links">
                <h3>Линкови</h3>
                <ul>
                    <li><a href="http://www.spc.rs/" target="_blank">Српска православна црква</a></li>
                    <li><a href="https://www.mitropolijadabrobosanska.org/" target="_blank">Митрополија дабробосанска</a></li>
                    <li><a href="{{ url('/') }}" target="_blank">Црква Мокро</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-foot">
            <p>&copy; 2022 Црква Мокро</p>
        </div>
    </div>
</div>