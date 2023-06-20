@extends('layouts.app')

@section('title', 'Книги')

@section('content')

    <a href="{{ route('todos.index') }}">Назад</a>

    <hr>

    <img src="{{ asset('/storage/' . $todo->img) }}" alt="{{ $todo->title }}" width="600px" height="600px">

@endsection
