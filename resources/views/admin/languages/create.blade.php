@extends('layouts.admin')

@section('title', 'Добавление языка')

@section('content')
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <h1>➕ Добавить язык обучения</h1>
        @include('admin.languages._form', ['action' => route('admin.languages.store')])
    </div>
@endsection