<?php
$help = [
    'project_id' => 'Необходимо привязать раздел к проекту',
    'title' => 'Заголовок раздела',
    'sort' => 'Номер по порядку',
];

$pageName = 'Редактирование задачи';
$page = 'admin.tasks.tasks.';
?>

@extends('layouts.admin')

@push('styles')
{{--    @vite('resources/css/admin/posts.css')--}}
@endpush

@section('title', $pageName)

@section('header-block')
    <span>{{ $pageName }}: ({{ $section->id }}) {{ $section->title }}</span>
    @include('admin.includes._header_block')
@endsection

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-2 mb-3">
        <form id="edit-form" class="item w-100" method="POST" enctype="multipart/form-data"
              action="{{ route($page . 'update', $section) }}" novalidate>
            @csrf
            @method('PATCH')

            @include('admin.includes._result_messages')
            <div class="col-lg-12 catalog-content">
                <div class="row">

                    <div class="col-xl-12 item-navbar">
                        <div class="navbar-content">
                            <ul class="nav nav-tabs flex-row flex-wrap d-flex box" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" type="button"
                                            role="tab" data-bs-target="#basic" aria-controls="basic" aria-selected="true">
                                        Основные данные
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="other-tab" data-bs-toggle="tab" type="button" role="tab"
                                            data-bs-target="#other" aria-controls="other" aria-selected="false">
                                        Прочие данные
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl-12 item-content tab-content">

                        <div id="basic" class="item-basic tab-pane fade show active" role="tabpanel"
                             aria-labelledby="basic-tab">
                            <div class="box">
                                <div class="row justify-content-center">
                                    <div class="col-xl-8 block">
                                        <div class="form-group row mandatory">
                                            <label class="col-sm-4 form-control-label">Проект</label>
                                            <div class="col-sm-8">
                                                <select class="form-select item-status" required="required"
                                                        name="project_id">
                                                    {!! projects()->selectTree($section->project_id) !!}
                                                </select>
                                            </div>
                                            <div class="col-sm-12 help-text">{{ $help['project_id'] }}</div>
                                        </div>
                                        <div class="form-group row mandatory">
                                            <label class="col-sm-4 form-control-label">Заголовок</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text"
                                                       name="title"
                                                       placeholder="Заголовок раздела"
                                                       value="{{ old('title', $section->title) }}"
                                                       required="required">
                                            </div>
                                            <div class="col-sm-12 help-text">{{ $help['title'] }}</div>
                                        </div>
                                        <div class="form-group row mandatory">
                                            <label class="col-sm-4 form-control-label">Цвет</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="color"
                                                       name="properties[color]"
                                                       placeholder="Цвет раздела"
                                                       value="{{ old('properties[color]', $section->color) }}"
                                                       required="required">
                                            </div>
                                            <div class="col-sm-12 help-text">{{ $help['title'] }}</div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 form-control-label">Порядковый номер</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text"
                                                       name="sort"
                                                       placeholder="Номер по порядку"
                                                       value="{{ old('sort', $section->sort) }}">
                                            </div>
                                            <div class="col-sm-12 help-text">{{ $help['sort'] }}</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="other" class="tab-pane fade" role="tabpanel" aria-labelledby="other-tab">
                            <div class="box">

                                <div class="form-group row">
                                    <label class="col-sm-4 form-control-label">Дата создания</label>
                                    <div class="col-sm-8">
                                        {{ $section->created_at }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 form-control-label">Дата обновления</label>
                                    <div class="col-sm-8">
                                        {{ $section->updated_at }}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/Sortable.min.js') }}" defer></script>
    @vite('resources/js/admin/sections.js')
@endpush
