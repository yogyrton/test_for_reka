@extends('layouts.app')

@section('title', 'Теги')

@section('content')

    <form>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Название тега</label>
            <input type="text" name="title" class="form-control" id="title"
                   aria-describedby="emailHelp" value="{{ old('title') }}">
            <div id="tag-error" ></div>
        </div>

        <button  id="add-tag" type="submit" class="btn btn-primary">Добавить тег</button>
    </form>

    <hr>

    @if($tags->count() > 0)

        <table class="table table-striped projects">

            <thead>
            <tr>

                <th style="width: 3%">
                    ID
                </th>

                <th style="width: 10%">
                    Название тега
                </th>

                <th style="width: 10%">
                    Действия
                </th>

            </tr>
            </thead>

            <tbody>
            @foreach($tags as $tag)
                <tr>

                    <td>
                        {{ $tag->id }}
                    </td>

                    <td>
                        {{ $tag->title }}
                    </td>

                    <td class="project-actions text-right">
                        <a class="btn btn-info btn-sm" href="{{ route('tags.edit', $tag->id) }}">Редактировать</a>

                        <form>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm delete-tag" data-id="{{ $tag->id }}">Удалить</button>
                        </form>

                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

    @else

        Тегов еще нет

    @endif

@endsection
