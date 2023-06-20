@extends('layouts.app')

@section('title', 'Добавить todo')

@section('content')

    <a href="{{ route('todos.index') }}">Назад</a>

    <hr>

    <form action="{{ route('todos.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Название todo</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1"
                   aria-describedby="emailHelp" value="{{ old('title') }}">
            <div id="emailHelp" class="form-text">Минимум 3 символа, максимум 100, обязательно</div>
        </div>

        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror


        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Картинка</label>
            <input type="file" name="img" class="form-control @error('img') is-invalid @enderror" id="exampleInputEmail1"
                   aria-describedby="emailHelp" value="{{ old('img') }}">
            <div id="emailHelp" class="form-text">Не более 8 МБ, обязательно</div>
        </div>

        @error('img')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror


        @if($tags->count() > 0)
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Выберите теги</label>
            <select class="form-select" multiple aria-label="multiple select example" name="tags[]">
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                @endforeach
            </select>
        </div>

        @else
            Для начала <a href="{{ route('tags.index') }}">создайте теги</a>
        @endif

        @error('tags')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <hr>

        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
@endsection
