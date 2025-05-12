<?php
$help = [
    'project_id' => 'Необходимо привязать раздел к проекту',
    'title' => 'Заголовок раздела',
    'color' => 'Установите цвет оформления раздела',
    'sort' => 'Номер по порядку',
];

$pageName = 'Новый раздел';
$page = 'admin.task.sections.';
?>

@extends('layouts.admin')

@section('title', $pageName)

@push('styles')
{{--    @vite('resources/css/admin/posts.css')--}}
@endpush

@section('title', $pageName)

@section('header-block')
    <span>{{ $pageName }}</span>
    @include('admin.includes._header_block')
@endsection

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-2 mb-3">
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
                                    <button type="button" id="basic-tab" class="nav-link active" data-bs-toggle="tab"
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
                                    <div class="col-xl-8 block">
                                        <div class="form-group row mandatory">
                                            <label class="col-sm-4 form-control-label">Проект</label>
                                            <div class="col-sm-8">
                                                <select name="project_id" class="form-select item-status"
                                                        required="required">
                                                    {!! projects()->selectTree(0) !!}
                                                </select>
                                            </div>
                                            <div class="col-sm-12 help-text">{{ $help['project_id'] }}</div>
                                        </div>
                                        <div class="form-group row mandatory">
                                            <label class="col-sm-4 form-control-label">Заголовок</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="title"
                                                       class="form-control js-title"
                                                       value="{{ old('title') }}"
                                                       required="required"
                                                       placeholder="Заголовок раздела">
                                            </div>
                                            <div class="col-sm-12 help-text">{{ $help['title'] }}</div>
                                        </div>
                                        <div class="form-group row mandatory">
                                            <label class="col-sm-4 form-control-label">Цвет</label>
                                            <div class="col-sm-8">
                                                <input type="color" name="properties[color]"
                                                       class="form-control"
                                                       value="{{ old('properties[color]') }}"
                                                       required="required"
                                                       placeholder="Цвет раздела">
                                            </div>
                                            <div class="col-sm-12 help-text">{{ $help['color'] }}</div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 form-control-label">Порядковый номер</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="sort"
                                                       class="form-control"
                                                       value="{{ old('sort') }}"
                                                       placeholder="Номер по порядку">
                                            </div>
                                            <div class="col-sm-12 help-text">{{ $help['sort'] }}</div>
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
@endsection
@push('scripts')
    <script src="{{ asset('js/Sortable.min.js') }}" defer></script>
    @vite('resources/js/admin/sections.js')
@endpush
