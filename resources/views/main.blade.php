@extends('layouts.app')

@section('title', 'Главная')

@section('content')

    @guest()
        <h3>Чтобы стал доступен Todo list</h3><a href="{{ route('register') }}">Зарегистрируйся</a>
    @endguest

    @auth()
        <h3>Перейдите к </h3><a href="{{ route('todos.index') }}">Todo list</a>
    @endauth

@endsection
