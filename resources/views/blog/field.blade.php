<div class="row">
    <div class="form-group">
        {!!  Form::label("title","Title") !!}
        {!!  Form::text('title',null,['class'=>"form-control","id"=>"title","placeholder"=>"Enter Title"]) !!}
        @error('title')
        <small class="form-text text-muted invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
    </div>
    <div class="form-group">
        {!!  Form::label("description","Description") !!}
        {!!  Form::textarea('description',null,['class'=>"form-control","id"=>"description","placeholder"=>"Enter Description"]) !!}
        @error('description')
        <small class="form-text text-muted invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
    </div>
    <div class="form-group">
        {!!  Form::label("image","Image") !!}
        {!!  Form::file('image',['class'=>"form-control","id"=>"image"]) !!}
        @error('image')
        <small class="form-text text-muted invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
    </div>
    <div class="tags">
        <div class="row">
            <div class="col-md-10">
                <div class="form-group">
                    {!!  Form::label("tag","Tag") !!}
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">#</div>
                        </div>
                        {{--                        {{ dd() }}--}}
                        {!!  Form::text('tag[]', isset($blog) && $blog->HashTag ? current($blog->HashTag) : null,['class'=>"form-control","id"=>"tag","placeholder"=>"Enter Tag"]) !!}
                        {{--                        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Username">--}}
                    </div>

                    @error('tag')
                    <small class="form-text text-muted invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
                @if(count($blog->HashTag ?? []) > 1)
                    @foreach($blog->HashTag as $k=>$v)
                        @if($k==0)
                            @continue(1)
                        @endif
                        <div class="row">
                            <div class="col-md-10">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">#</div>
                                    </div>
                                    {!!  Form::text('tag[]',$v,['class'=>"form-control tags-input","placeholder"=>"Enter Tag"]) !!}

                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger remove-tag">-</button>
                            </div>

                        </div>
                    @endforeach
                @endif
            </div>
            <div class="col-md-2">
                <br>
                <button type="button" class="btn btn-primary add-tag">+</button>
            </div>
        </div>
        <br>
    </div>

</div>
<div class="row mt-5">
    <div class="form-group  mb-0">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">
                {{ $type }}
            </button>
        </div>
    </div>
</div>
@section('script')
    <script>
        var tag = `<div class="row">
            <div class="col-md-10">
                  <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">#</div>
                        </div>
        {!!  Form::text('tag[]',null,['class'=>"form-control tags-input","placeholder"=>"Enter Tag"]) !!}

        </div>
    </div>
    <div class="col-md-2">
        <button type="button" class="btn btn-danger remove-tag">-</button>
    </div>

</div>

`
        $(document).on('click', ".add-tag", function () {
            $('.tags').append(tag);
            // setInterval(
            $(".tags-input").each(function () {
                $(this).rules("add", {
                    required: true,
                    lettersonly: true
                });
                $(this).focus();
            });

        })
        $(document).on('click', ".remove-tag", function () {
            if (confirm("Are you sure to remove tag"))
                $(this).parent().closest('.row').remove();
        })
        $('#CreateBlog').validate({ // initialize the plugin
            rules: {
                title: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                description: {
                    required: true,
                    minlength: 3,
                    maxlength: 65535
                },
                image: {
                    @if(!isset($blog))
                    required: true,
                    @endif
                    extension: "jpg,jpeg,png",
                    filesize: 100
                },
                "tag[]": {
                    required: true,
                    lettersonly: true
                }
            }
        });
    </script>
@endsection
