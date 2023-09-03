<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Telegraph</title>
</head>
<body>

<div class="container"><nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid p-0">
            <a class="navbar-brand" href="{{route('models.index')}}">Telegraph</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('models.index')}}">Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('models.create')}}">Create Note</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>@yield('content')</div>
</body>
</html>

