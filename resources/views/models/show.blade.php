@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <h2 class="h1 mb-3">{{$model->title}}</h2>
                <p class="mb-3">{{$model->author}}</p>
                <p class="mb-3">{{$model->created_at}}</p>
                <p class="mb-3">{{$model->text}}</p>
                <a class="btn btn-primary" href="{{route('models.index')}}" role="button">Back</a>
                <a class="btn btn-outline-success" href="{{route('models.edit', $model->id)}}">Edit</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form method="post" action="{{ route('models.destroy', $model->id)}}">
                    @csrf
                    @method('DELETE')
                    <input  class=" btn btn-outline-danger" type="submit" value="Delete">
                </form>
            </div>
        </div>
@endsection
