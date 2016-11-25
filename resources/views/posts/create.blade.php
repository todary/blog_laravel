@extends('layouts.app')


@section('content')

<script src="{{ URL::asset('js/tinymce/tinymce.min.js')}}"></script>
<script type="text/javascript">
	tinymce.init({
		selector : "textarea",
		plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages"],
		toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
	}); 
</script>


<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> New Post  </div>

                <div class="panel-body">
                    {{ Form::open() }}
                    <div class="form-group">
                        <input required="required" value="{{ old('title') }}" placeholder="Enter title here" type="text" name = "title"class="form-control" />
                    </div>
                    <div class="form-group">
                        <textarea name='body'class="form-control">{{ old('body') }}</textarea>
                    </div>
                    <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
                    <input type="submit" name='save' class="btn btn-default" value = "Save Draft" />

                    {{ Form::close() }}
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
