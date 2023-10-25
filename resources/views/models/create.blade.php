@extends('layouts.main');
@section('content')
    <div>
        <form action="{{route('models.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{old('title')}}">
                @error('title')
                <p class="text-bg-danger">$message</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="text" class="form-label">Text</label>
                <textarea class="form-control" name="text" id="text" rows="4">{{old('text')}}</textarea>
            </div>
            @error('text')
            <p class="text-bg-danger">$message</p>
            @enderror
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="author" class="form-control" id="name" placeholder="Anonymous" value="{{old('name')}}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="my_mail@mail.ru">
            </div>
            @error('email')
            <p class="text-bg-danger">$message</p>
            @enderror
            <div class="form-group">
                <label for="category">Choose category</label>
                <select class="form-select form-select-sm mb-3" id="category" name="category_id"
                        aria-label="Small select example">
                    @foreach($categories as $category)
                        <option
                            {{old('category_id') == $category->id ? 'selected' : ''}}
                            value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>
            @error('category')
            <p class="text-bg-danger">$message</p>
            @enderror
            <div class="form-group mb-3">
                <label for="tags[]">Choose tags</label>
                <select class="form-select form-select-sm" multiple aria-label="Multiple select example" name="tags[]">
                @foreach($tags as $tag)
                        <option
                            {{old('tags') != null && in_array($tag->id, old('tags')) ? 'selected' : ''}}
                            value="{{$tag->id}}">{{$tag->title}}</option>
                @endforeach
                </select>
            </div>
            @error('tags[]')
            <p class="text-bg-danger">$message</p>
            @enderror
            <button class="btn btn-outline-primary" type="submit">Submit</button>
        </form>
    </div>
@endsection()


