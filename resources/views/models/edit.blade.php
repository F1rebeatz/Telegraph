@extends('layouts.main');
@section('content')
    <div>
        <form action="{{route('models.update', $model->id)}}" method="post">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Title"
                       value="{{$model->title}}">
            </div>
            <div class="mb-3">
                <label for="text" class="form-label">Text</label>
                <textarea class="form-control" name="text" id="text" rows="4">{{$model->text}}</textarea>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="author" class="form-control" id="name" placeholder="Anonymous"
                       value="{{$model->author}}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="my_mail@mail.ru" value="{{$model->email}}">
            </div>
            <button class=" btn btn-outline-primary" type="submit">Update</button>
        </form>
    </div>
@endsection
