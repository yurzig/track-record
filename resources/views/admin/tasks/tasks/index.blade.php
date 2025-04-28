<?php
$fields = [
    ['name' => 'Id',               'dbName' => 'id',          'type' => 'text',   'op' => '=',    'class' => ''],
    ['name' => 'Проект',           'dbName' => 'project_id',  'type' => 'select', 'op' => '=',    'class' => ''],
    ['name' => 'Раздел',           'dbName' => 'section_id',  'type' => 'select', 'op' => '=',    'class' => ''],
    ['name' => 'Наименование',     'dbName' => 'title',       'type' => 'text',   'op' => 'like', 'class' => ' class=js-title'],
    ['name' => 'Описание',         'dbName' => 'description', 'type' => 'text',   'op' => 'like', 'class' => ''],
    ['name' => 'Дата начала',      'dbName' => 'date_start',  'type' => 'text',   'op' => '=',    'class' => ' class=flatpickr-input'],
    ['name' => 'Дата окончания',   'dbName' => 'date_end',    'type' => 'text',   'op' => '=',    'class' => ' class=flatpickr-input'],
    ['name' => 'В работе',         'dbName' => 'in_work',     'type' => 'text',   'op' => '=',    'class' => ''],
    ['name' => 'Тип',              'dbName' => 'type',        'type' => 'text',   'op' => '=',    'class' => ''],
    ['name' => 'Комментарий',      'dbName' => 'comments',    'type' => 'text',   'op' => 'like', 'class' => ''],
    ['name' => 'Скрыть до...',     'dbName' => 'hide_until',  'type' => 'text',   'op' => '=',    'class' => ''],
    ['name' => 'Порядковый номер', 'dbName' => 'sort',        'type' => 'text',   'op' => '=',    'class' => ''],
    ['name' => 'Дата создания',    'dbName' => 'created_at',  'type' => 'date',   'op' => '=',    'class' => ' class=flatpickr-input'],
    ['name' => 'Дата обновления',  'dbName' => 'updated_at',  'type' => 'date',   'op' => '=',    'class' => ' class=flatpickr-input'],
];

$sort = tasks()->getSort(['id', 'asc']);
$filter = tasks()->getFilters();
$columns = tasks()->getColumns(['id', 'project_id', 'title', 'sort']);

if (in_array('project_id',$columns)) {
    $project_id_items = [];
    $project_id_options = '<option value="">Все</option>';
    foreach (projects()->getForSelect() as $projectItem) {
        $project_id_items[$projectItem->id] = $projectItem->title;

        $selected = '';
        if (is_array($filter) && !empty($filter) && $filter['val']['project_id'] == $projectItem->id) {
            $selected = " selected='selected'";
        }
        $project_id_options .= "<option value='$projectItem->id'$selected>$projectItem->title</option>";
    }
}
if (in_array('section_id',$columns)) {
    $section_id_items = [];
    $section_id_options = '<option value="">Все</option>';
    foreach (sections()->getForSelect() as $sectionItem) {
        $section_id_items[$sectionItem->id] = $sectionItem->title;

        $selected = '';
        if (is_array($filter) && !empty($filter) && $filter['val']['section_id'] == $sectionItem->id) {
            $selected = " selected='selected'";
        }
        $section_id_options .= "<option value='$sectionItem->id'$selected>$sectionItem->title</option>";
    }
}

$pageName = 'Задачи';
$page = 'admin.tasks.';
?>
@extends('layouts.admin')

@push('styles')
{{--    @vite('resources/css/test.css')--}}
@endpush

@section('title', $pageName)

@section('header-block')
    <span>{{ $pageName }}</span>
@endsection

@section('content')
    @include('admin.includes._result_messages')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-2 mb-3">
        @include('admin.includes._list', ['page' => $page])
    </div>
    @if($items->total() > $items->count())
        <div class="list-page d-flex justify-content-center">
            {{ $items->onEachSide(2)->links() }}
        </div>
    @endif

    <!-- Modal -->
    @include('admin.includes._modal_columns', ['action' => route($page . 'columns')])
    @include('admin.includes._modal_delete')
@endsection

@push('scripts')
@endpush
