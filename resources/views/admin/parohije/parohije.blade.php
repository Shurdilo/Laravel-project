@extends('admin.layout.layout')
@section('content')

<div class="parohije">
    <h3>Парохије</h3>
    <div class="parohije-wrapper">
        @foreach($parohije as $parohija)
            <div class="parohija-wrapper">
                <a href="parohije/parohija/{{ $parohija->id }}" class="parohija-card">
                    <div class="icon"><i class="fas fa-info-circle"></i></div>
                    <div class="name">{{ $parohija->name }}</div>
                    <div class="paroh">{{ $parohija->paroh }}</div>
                </a>
            </div>
        @endforeach
    </div>
</div>

@endsection