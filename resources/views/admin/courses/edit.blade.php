@extends('layouts.admin')

@section('title', 'Редактирование курса')

@section('content')
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <h1>✏️ Редактирование курса</h1>
        
        @include('admin.courses._form', [
            'action' => route('admin.courses.update', $course)
        ])
    </div>
@endsection