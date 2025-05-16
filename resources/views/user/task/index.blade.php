<?php
$pageName = 'Задачи';
?>
@extends('layouts.user')

@push('styles')
{{--    @vite('resources/css/test.css')--}}
@endpush

@section('title', $pageName)

{{--@section('header-block')--}}
{{--    <span>{{ $pageName }}</span>--}}
{{--@endsection--}}

@section('content')
    <p>Страница задач</p>
@endsection

@push('scripts')
@endpush
