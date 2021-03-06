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

<h2 class="blog-post-title">Create a new article</h2>

@include('errors.list')

{{-- Check if current user is logged-in or a guest --}}
@if (Auth::guest())
		
	<p class="alignleft">
		You have to be logged in to add an article. Please <a href="/login/">login</a>.
	</p>
		
@else
	{{ Form::open(['route' => 'articles.store', 'files' => true]) }}
		@include('articles.partials._form', [ 'submitButtonText' => 'Create Article'])
	{{ Form::close() }}
@endif

@stop

