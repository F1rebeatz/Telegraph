@extends('layouts.main');
@section('content')
    <div>
        <form action="{{route('models.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Title">
            </div>
            <div class="mb-3">
                <label for="text" class="form-label">Text</label>
                <textarea class="form-control" name="text" id="text" rows="4"></textarea>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="author" class="form-control" id="name" placeholder="Anonymous">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="my_mail@mail.ru">
            </div>
            <button class="btn btn-outline-primary" type="submit">Submit</button>
        </form>
    </div>
@endsection()


