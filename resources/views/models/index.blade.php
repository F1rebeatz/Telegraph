@extends('layouts.main')
@section('content')
    <h1 class="h1">Your notes:</h1>
    <ul>
        @foreach ($models as $model)
            <li>
                <span>{{$loop->iteration}}.</span>
                <a href="{{ route('models.show', $model->id) }}">{{ $model->title }}</a>
            </li>
        @endforeach
    </ul>
@endsection
