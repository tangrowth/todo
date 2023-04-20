@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="todo__alert">
  <div class="todo__alert--success">
    @if(session('message'))
    {{ session('message') }}
    @endif
  </div>
</div>

<div class="todo__content">
  <form class="create-form" action="/todos" method="post">
    @csrf
    <div class="create-form__item">
      <input class="create-form__item-input" type="text" name="content">
    </div>
    <div class="create-form__button">
      <button class="create-form__button-submit" type="submit">作成</button>
    </div>
  </form>
  <div class="todo-table">
    <table class="todo-table__inner">
      <tr class="todo-table__row">
        <th class="todo-table__header">Todo</th>
      </tr>
      @foreach ($todos as $todo)
      <tr class="todo-table__row">
        <td class="todo-table__item">
          <form class="update-form" action="/todos/update" method="POST">
            @method('PATCH')
            @csrf
            <div class="update-form__item">
              <input class="update-form__item-input" type="text" name="content" value="{{ $todo['content'] }}">
              <input type="hidden" name="id" value="{{ $todo['id'] }}">
            </div>
            <div class="update-form__button">
              <button class="update-form__button-submit" type="submit">更新</button>
            </div>
          </form>
        </td>
        <td class="todo-table__item">
          <form class="delete-form" action="/todos/delete" method="POST">
            @method('DELETE')
            @csrf
            <div class="delete-form__button">
              <input type="hidden" name="id" value="{{ $todo['id'] }}">
              <button class="delete-form__button-submit" type="submit">削除</button>
            </div>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection