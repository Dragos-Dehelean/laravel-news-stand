@extends('layouts.pdf')
@section('content')


<h2>{{ $article->title }}</h2>


<p>
	<strong>Published</strong>: {{ $article->created_at->format('M d, Y h:i a') }} | <strong>Reporter</strong>: {{ $article->author->name }}
</p>


<div>
{!! $article->text !!}
</div>



@stop