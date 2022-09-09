@extends('admin.layout.layout')
@section('content')

<div class="add-admin">
    <h3>Нови админ</h3>
    <form action="{{ url('admin/admins/add-admin') }}" method="post">@csrf
        <div class="form-group">
            <label>Чин и име</label>
            <input id="name" name="name" type="text" placeholder="Протојереј Марко Марковић" class="form-control">
        </div>
        <div class="form-group">
            <label>Е-маил</label>
            <input id="email" name="email" type="text" placeholder="markomarkovic@crkvamokro.org" class="form-control">
        </div>
        <div class="form-group">
            <label>Лозинка</label>
            <input id="password" name="password" type="password" placeholder="Лозинка" class="form-control">
        </div>
        <button id="submit" class="submit button">Додај админа</button>
    </form>
</div>

@endsection