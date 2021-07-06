@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">Add New Blog</div>

                    <div class="card-body">
                        {{ Form::open(["route"=>['blog.store'],"files"=>true ,"id"=>"CreateBlog"]) }}
                        @include('blog.field',["type"=>"Add Blog"])
                       {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
