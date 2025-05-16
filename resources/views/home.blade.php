@extends('layouts.app')

@push('meta')
    <title>Главная</title>
    <meta name="description" content="Главная страница">
@endpush

@section('content')
    <h1>Привет!!!</h1>
    <br>
    <a class="btn" href="{{ route('user.task') }}" title="Блок задач">
        Задачи
    </a>
@endsection
