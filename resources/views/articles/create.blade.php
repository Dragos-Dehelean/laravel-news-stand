@extends('layouts.main')
@section('content')

<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
  tinymce.init({
    selector : "textarea",
    plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
    toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
  }); 
</script>


{!! Form::close() !!}


<h2 class="blog-post-title">Create a new article</h2>

{{-- Check if current user is logged-in or a guest --}}
@if (Auth::guest())
		
	<p class="alignleft">
		You have to be logged in to add an article. Please <a href="/login/">login</a>.
	</p>
		
@else

	{{ Form::open(['route' => 'articles.store', 'files' => true]) }}		
		
		{{ csrf_field() }}

		<input type="hidden" name="author_id" value="{{ Auth::id() }}" />

		<div class="form-group">
			{{ Form::label( 'title', 'News Item Title' ) }}
			{{ Form::text( 'title', null, ['class' => 'form-control'] ) }}
		</div>

		<div class="form-group">
			{{ Form::label( 'thumbnail', 'News Item Thumbnail' ) }}
			{{ Form::file( 'thumbnail', ['class' => 'form-control'] ) }}
		</div>

		<div class="form-group">
			{{ Form::label( 'text', 'News Item Text' ) }}
			{{ Form::textarea( 'text', null, ['class' => 'form-control'] ) }}
		</div>
		
		<div class="form-group">
			{{ Form::submit( 'Submit', ['class' => 'btn btn-success btn-block'] ) }}
		</div>

	{{ Form::close() }}

@endif
	

@stop

