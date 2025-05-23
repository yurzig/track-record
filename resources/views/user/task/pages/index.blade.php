<?php
$pageName = 'Задачи';
// TODO Сделать для user файл common.css c фонтавесом
// TODO сделать шаблоны кнопки, иконки, меню
?>
@extends('user.task.layout')

@push('styles')
    {{--    @vite('resources/css/test.css')--}}
@endpush

@section('title', $pageName)

{{--@section('header-block')--}}
{{--    <span>{{ $pageName }}</span>--}}
{{--@endsection--}}

@section('content')
    <p>Страница задач</p>
    <div class="content d-flex">
        <nav class="nav flex-column p-2">
            <button type="button" class="btn fa fa-arrow-circle-left"
                    data-bs-toggle="modal"
                    data-bs-target="#columns-form"
                    title="Колонки">
            </button>
            <a class="nav-link active" aria-current="page" href="#">Активная</a>
            <a class="nav-link" href="#">Ссылка</a>
            <a class="nav-link" href="#">Ссылка</a>
            <a class="nav-link disabled">Отключенная</a>
        </nav>
        <div class="section p-2">block 1</div>
        <div class="section p-2">block 1</div>
        <div class="section p-2">block 1</div>
        <div class="section p-2">block 1</div>
    </div>
@endsection

@push('scripts')
@endpush
