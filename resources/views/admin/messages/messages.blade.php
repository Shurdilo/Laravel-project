@extends('admin.layout.layout')
@section('content')

<div class="messages">
    <h3>Поруке</h3>
    <div class="messages-wrapper" id="messages">
        @foreach($messages as $message)
            <div class="message-wrapper">
                <a href="javascript:void(0)" message_id="{{ $message->id }}" status="{{ $message->status }}" class="message-card @if($message['status']=="0")active @endif">
                    <div class="icon"><i class="fas fa-comments"></i></div>
                    <div class="user">
                        <div class="name">{{ $message->name }}</div>
                        <div class="email">{{ $message->email }}</div>
                    </div>
                    <div class="question"><span class="title">{{ $message->theme }} </span><span class="message">- {{ $message->message }}</span></div>
                    @if($message['status']=="0")
                        <div class="new-message-indicator"><i class="fas fa-circle"></i></div>
                    @endif
                    <div class="date">{{ $message->created_at->diffForHumans($now); }}</div>
                </a>           
                <a href="javascript:void(0)" class="confirmDeleteMessage" recordid="{{ $message->id }}" title="Избриши поруку"><i class="fas fa-trash-alt"></i></a> 
            </div>
        @endforeach
    </div>
    {{ $messages->links() }}
</div>

<script src="https://cdn.tailwindcss.com"></script>

@endsection