@extends('layouts.admin')

@section('title', 'Добавление курса')

@section('content')
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <h1>➕ Добавить новый курс</h1>
        
        @include('admin.courses._form', [
            'action' => route('admin.courses.store')
        ])
    </div>
@endsection