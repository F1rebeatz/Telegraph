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
                <input type="email" name="email" class="form-control" id="email" placeholder="my_mail@mail.ru"
                       value="{{$model->email}}">
            </div>
            <div class="form-group">
                <label for="category">Choose category</label>
                <select class="form-select form-select-sm mb-3" id="category" name="category_id"
                        aria-label="Small select example">
                    @foreach($categories as $category)
                        {{$category->id === $model->category_id ? 'selected': ''}}
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="tags[]">Choose tags</label>
                <select class="form-select" multiple aria-label="Multiple select example" name="tags[]">
                    @foreach($tags as $tag)
                        <option
                            @foreach($model->tags as $modelTag )
                                {{$tag->id === $modelTag->id ? 'selected': ''}}
                            @endforeach
                            value="{{$tag->id}}">{{$tag->title}}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-outline-primary" type="submit">Update</button>
        </form>
    </div>
@endsection
