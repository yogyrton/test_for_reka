@extends('layouts.app')

@section('title', 'Todos')

@section('content')

    <a href="{{ route('todos.create') }}">Добавить todo</a>

    <hr>

    <form action="">
        <label class="p-3" for="search">Поиск</label><input type="text" name="search" id="search">

        <button class="btn btn-primary" type="submit">Найти</button>

        <a class="btn btn-danger" href="{{ route('todos.index') }}">Сброс</a>
    </form>


    @if($todos->count() > 0)

        <table class="table table-striped projects">

            <thead>
            <tr>

                <th style="width: 3%">
                    ID
                </th>

                <th style="width: 10%">
                    Todo
                </th>

                <th style="width: 10%">
                    Картинка
                </th>

                <th style="width: 10%">
                    Теги
                </th>

                <th style="width: 10%">
                    Действия
                </th>

            </tr>
            </thead>

            <tbody>
            @foreach($todos as $todo)
                <tr>

                    <td>
                        {{ $todo->id }}
                    </td>

                    <td>
                        <a href="{{ route('todos.show', $todo) }}">{{ $todo->title }}</a>
                    </td>

                    <td>
                        <img src="{{ asset('/storage/' . $todo->img) }}" alt="{{ $todo->title }}" width="150px" height="150px">
                    </td>

                    <td>

                        @foreach($todo->tags as $tag)

                            {{ $tag->title }}

                        @endforeach

                    </td>

                    <td class="project-actions text-right">
                        <a class="btn btn-info btn-sm" href="{{ route('todos.edit', $todo->id) }}">Редактировать</a>

                        <form action="{{ route('todos.destroy', $todo->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                        </form>

                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

    @else

        Todo еще нет

    @endif

@endsection
