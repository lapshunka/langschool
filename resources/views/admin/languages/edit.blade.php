@extends('layouts.admin')

@section('title', 'Редактирование языка')

@section('content')
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <h1>✏️ Редактирование языка</h1>
        @include('admin.languages._form', ['action' => route('admin.languages.update', $language)])
    </div>
@endsection