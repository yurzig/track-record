<?php
$help = [
    'post_id' => '',
    'user_id' => '',
    'rating' => '',
    'comment' => '',
    'response' => '',
    'status' => '',
];

$pageName = 'Новый отзыв';
$page = 'admin.post.reviews.';
?>
@extends('layouts.admin')

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
                                <div class="col-xl-6 block">
                                    <div class="form-group row mandatory">
                                        <label class="col-sm-4 form-control-label">Статья</label>
                                        <div class="col-sm-8">
                                            <select name="post_id" class="form-select select2"
                                                    required="required" data-placeholder="Укажите статью">
                                                <option></option>
                                                @foreach(posts()->getForSelect() as $post)
                                                    <option value={{ $post->id }}>{{ $post->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mandatory">
                                        <label class="col-sm-4 form-control-label">Пользователь</label>
                                        <div class="col-sm-8">
                                            <select name="user_id" class="form-select select2"
                                                    required="required"
                                                    data-placeholder="Пользователь оставивший отзыв">
                                                <option></option>
                                                @foreach (users()->getForSelect() as $user)
                                                    <option value={{ $user->id }}>{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 form-control-label">Рейтинг</label>
                                        <div class="col-sm-8">
                                            <input type="number" name="rating" class="form-control"
                                                   min="1" max="5"
                                                   value="{{ old('rating') }}"
                                                   placeholder="Рейтинг товара(1-5)">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 form-control-label">Комментарий</label>
                                        <div class="col-sm-8">
                                            <textarea name="comment" class="form-control item-content">{{ old('comment') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 form-control-label">Ответ</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="response" class="form-control flatpickr-input"
                                                   value="{{ old('response') }}"
                                                   placeholder="Ответ на комментарий">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 form-control-label">Статус</label>
                                        <div class="col-sm-8">
                                            <select name="status" class="form-select item-status" required="required">
                                                @foreach (postReviews()->getStatuses() as $key => $status) {
                                                <option value='{{ $key }}'>{{ $status }}</option>";
                                                @endforeach
                                            </select>
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
@endsection
