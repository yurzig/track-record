<?php
$fields = [
    ['name' => 'Id',               'dbName' => 'id',         'type' => 'text',   'op' => '=',    'class' => ''],
    ['name' => 'Проект',           'dbName' => 'project_id', 'type' => 'select', 'op' => '=',    'class' => ''],
    ['name' => 'Наименование',     'dbName' => 'title',      'type' => 'text',   'op' => 'like', 'class' => ' class=js-title'],
    ['name' => 'Порядковый номер', 'dbName' => 'sort',       'type' => 'text',   'op' => '=',    'class' => ''],
//    ['name' => 'Цвет',        'dbName' => 'excerpt',          'type' => 'text',   'op' => 'like', 'class' => ''],
    ['name' => 'Дата создания',    'dbName' => 'created_at', 'type' => 'date',   'op' => '=',    'class' => ' class=flatpickr-input'],
    ['name' => 'Дата обновления',  'dbName' => 'updated_at', 'type' => 'date',   'op' => '=',    'class' => ' class=flatpickr-input'],
];

$sort = sections()->getSort(['id', 'asc']);
$filter = sections()->getFilters();
$columns = sections()->getColumns(['id', 'project_id', 'title', 'sort']);

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

$pageName = 'Разделы';
$page = 'admin.tasks.sections.';
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
