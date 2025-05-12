<?php
$help = [
    'title' => '',
    'parent_id' => '',
];
$pageName = 'Проект';
$page = 'admin.task.projects.';
?>

@extends('layouts.admin')

@push('styles')
    @vite('resources/css/admin/projects.css')
@endpush

@section('title', $pageName)

@section('header-block')
    <span>{{ $pageName }}: ({{ $project->id }}) {{ $project->title }}</span>
    <div class="item-actions my-1">
        <a class="btn btn-secondary js-help" role="button" data-bs-toggle="button" aria-pressed="false"
           title="Подсказки" href="#">?</a>
        <a class="btn btn-secondary act-cancel" title="Переход на список" href="{{ route($page . 'index') }}">Список</a>

        <div class="btn-group">
            <button type="submit" form="edit-form" class="btn btn-primary act-save" title="Сохранить запись">Сохранить
            </button>
        </div>
    </div>
@endsection

@section('content')
    @include('admin.includes._result_messages')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap py-2">
        <div class="col-lg-4 box">
            {!! projects()->menuTree($project->id) !!}
        </div>
        <div class="col-lg-8 ps-2">
            <form method="POST" id="edit-form" class="item w-100" enctype="multipart/form-data"
                  action="{{ route($page . 'update', $project) }}" novalidate>
                @csrf
                @method('PATCH')

                <div class="col-lg-12 catalog-content">
                    <div class="row">

                        <div class="col-xl-12 item-navbar">
                            <div class="navbar-content">
                                <ul class="nav nav-tabs flex-row flex-wrap d-flex box" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button type="button" id="basic-tab" class="nav-link active" data-bs-toggle="tab"
                                                role="tab" data-bs-target="#basic" aria-controls="basic" aria-selected="true">
                                            Основные данные
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button type="button" id="other-tab" class="nav-link" data-bs-toggle="tab" role="tab"
                                                data-bs-target="#other" aria-controls="other" aria-selected="false">
                                            Прочие данные
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-12 item-content tab-content">

                            <div id="basic" class="tab-pane fade show active" role="tabpanel"
                                 aria-labelledby="basic-tab">
                                <div class="box">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-10 block">
                                            <div class="form-group row mandatory">
                                                <label class="col-sm-2 form-control-label">Название</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="title" class="form-control"
                                                           value="{{ old('title', $project->title) }}"
                                                           required="required"
                                                           placeholder="Название категории">
                                                </div>
                                                <div class="col-sm-12 help-text">{{ $help['title'] }}</div>
                                            </div>
                                            <div class="form-group row mandatory">
                                                <label class="col-sm-2 form-control-label">Родитель</label>
                                                <div class="col-sm-10">
                                                    <select name="parent_id" class="form-select" required="required">
                                                        <option value="0">0-й уровень</option>
                                                        {!! projects()->selectTree($project->parent_id) !!}
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 help-text">{{ $help['parent_id'] }}</div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="other" class="tab-pane fade" role="tabpanel" aria-labelledby="other-tab">
                                <div class="box">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-10 block">
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label">Дата создания</label>
                                                <div class="col-sm-9">
                                                    {{ $project->created_at }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-xl-10 block">
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label">Дата обновления</label>
                                                <div class="col-sm-9">
                                                    {{ $project->updated_at }}
                                                </div>
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
