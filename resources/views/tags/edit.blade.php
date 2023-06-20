@extends('layouts.app')

@section('title', 'Редактировать тег')

@section('content')

    <a href="{{ route('tags.index') }}">Назад</a>

    <hr>

    <form action="{{ route('tags.update', $tag) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Название тега</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1"
                   aria-describedby="emailHelp" value="{{ old('title', $tag->title) }}">
            <div id="emailHelp" class="form-text">Минимум 3 символа, максимум 100, обязательно</div>
        </div>

        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
@endsection
