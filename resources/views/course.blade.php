@extends('layouts.app')

@section('title', 'Каталог курсов — ' . config('app.name'))

@section('content')
    <h1>Каталог курсов</h1>
    @forelse ($items as $id => $item)
        <div class="card">
            <span class="badge">{{ $loop->iteration }}.</span>
            <h2><a href="{{ route('courses.show', $id) }}">{{ $item['title'] ?? 'Курс #' . $id }}</a></h2>
            <p>{{ $item['description'] ?? '' }}</p>
        </div>
    @empty
        <p>Каталог пока пуст.</p>
    @endforelse
@endsection