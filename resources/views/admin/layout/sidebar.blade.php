<nav class="sidebar">
    <a class="logo" href="/">
        <img src="{{ asset('universal/images/logo.png') }}" alt="Слика није пронађена">
        <p>Мокро</p>
    </a>
    <div class="sidebar-navigation">
        <ul>
            <li class="list @if(Session::get('page')=="dashboard") active @endif">
                <a href="/admin/dashboard">
                    <span class="icon"><i class="fas fa-home"></i></span>
                    <span class="title">Почетна</span>
                </a>
            </li>
            <li class="list @if(Session::get('page')=="news") active @endif">
                <a href="/admin/news">
                    <span class="icon"><i class="fas fa-newspaper"></i></span>
                    <span class="title">Новости</span>
                </a>
            </li>
            <li class="list">
                <a href="#">
                    <span class="icon"><i class="fas fa-clock"></i></span>
                    <span class="title">Богослужења</span>
                </a>
            </li>
            <li class="list @if(Session::get('page')=="parohije") active @endif">
                <a href="/admin/parohije">
                    <span class="icon"><i class="fas fa-info-circle"></i></ion-icon></span>
                    <span class="title">Парохије</span>
                </a>
            </li>
            <li class="list">
                <a href="#">
                    <span class="icon"><i class="fas fa-images"></i></span>
                    <span class="title">Галерија</span>
                </a>
            </li>
            <li class="list @if(Session::get('page')=="ljetopis") active @endif">
                <a href="/admin/ljetopis">
                    <span class="icon"><i class="fas fa-feather-alt"></i></i></span>
                    <span class="title">Љетопис</span>
                </a>
            </li>
            <li class="list @if(Session::get('page')=="admins") active @endif">
                <a href="/admin/admins">
                    <span class="icon"><i class="fas fa-user"></i></span>
                    <span class="title">Админи</span>
                </a>
            </li>
            <li class="list @if(Session::get('page')=="settings") active @endif">
                <a href="/admin/settings">
                    <span class="icon"><i class="fas fa-cog"></i></span>
                    <span class="title">Подешавања</span>
                </a>
            </li>
        </ul>
    </div>
</nav>