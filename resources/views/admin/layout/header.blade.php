<nav class="header">
    <h1>{{ $page }}</h1>
    <ul>
        <li class="list-item"><a href="/admin/messages"><i class="fas fa-comments"></i>@if($messageCounts > 0)<span class="badge">{{ $messageCounts }}</span>@endif</a></li>
        <li class="list-item"><a href="{{ url('admin/logout') }}" class="logout"><i class="fas fa-sign-out-alt"></i></a></li>
    </ul>
</nav>