@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">Update Blog</div>

                    <div class="card-body">
                        {{ Form::model($blog,["route"=>['blog.update',$blog->id],"files"=>true ,"id"=>"CreateBlog"]) }}
                        @method("PUT")
                        @include('blog.field',["type"=>"Update Blog"])
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
