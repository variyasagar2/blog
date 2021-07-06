<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>


        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        body {
            /*background: linear-gradient(to right, #c04848, #480048);*/
            min-height: 100vh
        }

        .text-gray {
            color: #aaa
        }

        img {
            height: 170px;
            width: 140px
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
            crossorigin="anonymous"></script>
</head>
<body>

<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
                <a href="{{ route('blog.create') }}">Add</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="container py-5">
            <div class="row text-center  mb-5">
                <div class="col-lg-7 mx-auto">
                    <h1 class="">Blogs</h1>
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($blogs as $blog)
                <div class="col-md-6">

                    <div class="card" style="width: 90%;margin: 5%">
                        <img src="{{ $blog->image }}" class="card-img-top ">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="card-text">{{ $blog->DescriptionShort  }}</p>
                            {{--                            {{ dd($blog->HashTag)  }}--}}
                            <div class="card-text">
                                @foreach($blog->HashTag as $tag)
                                    {{--                                  {{ $tag }}--}}
                                    <span class="badge bg-secondary badge-pill badge-secondary">#{{$tag}}</span>
                                @endforeach
                            </div>

                            @if($blog->user_id == (Auth::user()->id ?? null))
                                <br>
                                <a href="{{ route('blog.edit',$blog->id) }}" class="btn btn-primary">Edit</a>
                                {{ Form::open(['route'=>[ "blog.destroy",$blog->id]]) }}
                                    @method('delete')
                                <button class="btn btn-danger">Delete</button>
                                {{Form::close()}}
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
</body>
</html>
