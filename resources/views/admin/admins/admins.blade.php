@extends('admin.layout.layout')
@section('content')

<div class="admins">
    <div class="headTab">
        <h3>Админи</h3>
        <a id="add" href="admins/add-admin"><i class="fas fa-plus"></i><p>Додај админа</p></a>
    </div>
    <div class="admins-wrapper" id="admins">
        @foreach($admins as $admin)
            <div class="admin-wrapper">
                <a href="admins/admin/{{ $admin->id }}" class="admin-card">
                    <div class="icon"><i class="fas fa-user"></i></div>
                    <div class="user">
                        <div class="name">{{ $admin->name }}</div>
                        <div class="email">{{ $admin->email }}</div>
                    </div>
                </a>           
                @if($admin['id']!=1)
                    <a href="javascript:void(0)" class="confirmDeleteAdmin" recordid="{{ $admin->id }}" title="Избриши админа"><i class="fas fa-trash-alt"></i></a>
                @endif
            </div>
        @endforeach
    </div>
    {{ $admins->links() }}
</div>

<script src="https://cdn.tailwindcss.com"></script>
@endsection