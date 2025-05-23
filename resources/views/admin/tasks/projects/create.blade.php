<?php
$help = [
    'title' => '',
    'parent_id' => '',
];
$pageName = 'Новый проект';
$page = 'admin.task.projects.';
?>

@extends('layouts.admin')

@push('styles')
    @vite('resources/css/admin/projects.css')
@endpush

@section('title', $pageName)

@section('header-block')
    <span>{{ $pageName }}</span>
    <div class="item-actions my-1">
        <a class="btn btn-secondary js-help" role="button" data-bs-toggle="button" aria-pressed="false"
           title="Подсказки" href="#">?</a>
        <a class="btn btn-secondary act-cancel" title="Переход на список" href="{{ route($page . 'index') }}">Список</a>

        <div class="btn-group">
            <button type="submit" form="edit-form" class="btn btn-primary act-save" title="Сохранить запись">
                Сохранить
            </button>
        </div>
    </div>
@endsection

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap py-2">
        <div class="col-lg-4 box">
            {!! projects()->menuTree(0) !!}
        </div>

        <div class="col-lg-8 ps-2">
            <form method="POST" id="edit-form" class="item w-100" enctype="multipart/form-data"
                  action="{{ route($page . 'store') }}" novalidate>
                @csrf
                @include('admin.includes._result_messages')
                <div class="col-lg-12 catalog-content">
                    <div class="row">

                        <div class="col-xl-12 item-navbar">
                            <div class="navbar-content">
                                <ul class="nav nav-tabs flex-row flex-wrap d-flex box" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button type="button" class="nav-link active" id="basic-tab" data-bs-toggle="tab"
                                                role="tab" data-bs-target="#basic" aria-controls="basic" aria-selected="true">
                                            Ввод данных
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-12 item-content tab-content">
                            <div id="basic" class="tab-pane fade show active" role="tabpanel" aria-labelledby="basic-tab">
                                <div class="box">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-10 block">
                                            <div class="form-group row mandatory">
                                                <label class="col-sm-2 form-control-label">Название</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="title" class="form-control"
                                                           value="{{ old('title') }}"
                                                           required="required"
                                                           placeholder="Название проекта">
                                                </div>
                                                <div class="col-sm-12 help-text">{{ $help['title'] }}</div>
                                            </div>
{{--                                            <div class="form-group row">--}}
{{--                                                <label class="col-sm-2 form-control-label">Url</label>--}}
{{--                                                <div class="col-sm-10">--}}
{{--                                                    <input class="form-control" type="text"--}}
{{--                                                           name="slug"--}}
{{--                                                           placeholder="Уникальный идентификатор"--}}
{{--                                                           value="{{ old('slug') }}">--}}
{{--                                                </div>--}}
{{--                                                <div class="col-sm-12 help-text">{{ $help['slug'] }}</div>--}}
{{--                                            </div>--}}
                                            <div class="form-group row mandatory">
                                                <label class="col-sm-2 form-control-label">Родитель</label>
                                                <div class="col-sm-10">
                                                    <select name="parent_id" class="form-select item-status">
                                                        <option value="0">0-й уровень</option>
                                                        {!! projects()->selectTree($parent) !!}
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 help-text">{{ $help['parent_id'] }}</div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('admin.includes._modal_delete')
@endsection
@push('scripts')
    <script src="{{ asset('js/Sortable.min.js') }}" defer></script>
    @vite('resources/js/admin/projects.js')
@endpush
