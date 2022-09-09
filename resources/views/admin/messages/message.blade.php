@extends('admin.layout.layout')
@section('content')

<div class="message">
    <div class="message-icons">
        <div class="user">
            <i class="fas fa-user"></i>
        </div>
        <a href="/admin/messages" class="back">
            <div class="circle">
                <i class="fas fa-arrow-left"></i>
            </div>
        </a>
    </div>
    <div class="message-wrapper">
        
        <div class="name-group">
            <div class="name">{{ $message->name }}</div>
            <div class="date">
                <div class="created">{{ date('d.m.Y. H:m', strtotime($message->created_at)) }}</div>
                <div class="datedifferent">( Прије {{ $message->created_at->diffForHumans($now); }} )</div>
            </div>
        </div>
        <div class="email"><span class="span-text">Е-маил:</span> {{ $message->email }}</div>
        <div class="theme"><span class="span-text">Тема:</span> {{ $message->theme }}</div>
        <div class="phone"><span class="span-text">Број:</span> {{ $message->phone }}</div>
        <div class="text"><span class="span-text">Порука:</span> {{ $message->message }}</div>
    </div>
</div>

@endsection