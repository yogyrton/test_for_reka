@extends('layouts.app')

@section('title', 'Добавить тег')

@section('content')

    <a href="{{ route('tags.index') }}">Назад</a>

    <hr>

    <form action="{{ route('tags.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Название тега</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1"
                   aria-describedby="emailHelp" value="{{ old('title') }}">
            <div id="emailHelp" class="form-text">Минимум 3 символа, максимум 100, обязательно</div>
        </div>

        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
