<?php
$help = [
    'project_id' => 'Необходимо привязать задачу к проекту',
    'section_id' => 'Необходимо привязать задачу к разделу',
    'title' => 'Заголовок задачи',
    'description' => 'Описание задачи',
    'date_start' => 'Дата начала выполнения задачи',
    'date_end' => 'Дата окончания задачи',
    'in_work' => 'Задача выполняется или завершена',
    'type' => 'Тип: задача, разделитель или подзадача',
    'comment' => 'Комментарий задачи',
    'hide_until' => 'Дата, до которой может быть скрыта задача',
    'sort' => 'Номер по порядку',
];

$pageName = 'Новая задача';
$page = 'admin.tasks.';
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
{{--                                        TODO выводить разделы принадлежащие проекту --}}
                                        <div class="form-group row mandatory">
                                            <label class="col-sm-4 form-control-label">Раздел</label>
                                            <div class="col-sm-8">
                                                <select name="section_id" class="form-select item-status"
                                                        required="required">
                                                    @foreach (sections()->getForSelect() as $section)
                                                        <option value={{ $section->id }}>{{ $section->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-12 help-text">{{ $help['section_id'] }}</div>
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
                                        <div class="form-group row">
                                            <label class="col-sm-4 form-control-label">Описание</label>
                                            <div class="col-sm-8">
                                                <textarea name="description" class="summernote form-control item-content">
                                                    {{ old('description') }}
                                                </textarea>
                                            </div>
                                            <div class="col-sm-12 help-text">{{ $help['description'] }}</div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 form-control-label">Дата начала выполнения</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="date_start"
                                                       class="form-control flatpickr-input"
                                                       value="{{ old('date_start') }}"
                                                       placeholder="Начало выполнения задачи">
                                            </div>
                                            <div class="col-sm-12 help-text">{{ $help['date_start'] }}</div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 form-control-label">Дата окончания выполнения</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="date_end"
                                                       class="form-control flatpickr-input"
                                                       value="{{ old('date_end') }}"
                                                       placeholder="Окончание задачи">
                                            </div>
                                            <div class="col-sm-12 help-text">{{ $help['date_end'] }}</div>
                                        </div>
                                        <div class="form-group row mandatory">
                                            <label class="col-sm-4 form-control-label">Активна</label>
                                            <div class="col-sm-8 form-check form-switch">
                                                <input type="hidden" name="in_work" value="0">
                                                <input type="checkbox" name="in_work"
                                                           class="form-control form-check-input"
                                                           value="1"
                                                           checked>
                                            </div>
                                            <div class="col-sm-12 help-text">{{ $help['in_work'] }}</div>
                                        </div>
                                        <div class="form-group row mandatory">
                                            <label class="col-sm-4 form-control-label">Тип</label>
                                            <div class="col-sm-8">
                                                <select name="type" class="form-select item-status" required="required">
                                                    @foreach (tasks()->getTypes() as $key => $type)
                                                        <option value={{ $key }}>{{ $type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-12 help-text">{{ $help['type'] }}</div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 form-control-label">Комментарий</label>
                                            <div class="col-sm-8">
                                                <textarea name="comment" class="summernote form-control item-content">
                                                    {{ old('comment') }}
                                                </textarea>
                                            </div>
                                            <div class="col-sm-12 help-text">{{ $help['comment'] }}</div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 form-control-label">Скрыть задачу до даты</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="hide_until"
                                                       class="form-control flatpickr-input"
                                                       value="{{ old('hide_until') }}"
                                                       placeholder="Не показывать задачу до">
                                            </div>
                                            <div class="col-sm-12 help-text">{{ $help['hide_until'] }}</div>
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
{{--    <script src="{{ asset('js/Sortable.min.js') }}" defer></script>--}}
{{--    @vite('resources/js/admin/sections.js')--}}
@endpush
