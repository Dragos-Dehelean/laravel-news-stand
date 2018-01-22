   
@extends('layouts.main')
@section('content')

	<h2>{{ $article->title }}</h2> 

	<img src="/uploads/{{ $article->thumbnail }}" alt="{{ $article->title }}" class="pull-left img-thumbnail" >	

	<ul class="list-inline list-unstyled">
		<li>
			<span>
				<i class="glyphicon glyphicon-calendar"></i>
				{{ $article->created_at->format('M d, Y h:i a') }} 
			</span>
		</li>
		<li>|</li>
			<a href="{{ url('pdf/' . $article->id) }}" target="_blank"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-save"></span> PDF</button></a>
	    <li>|</li>

		@if( ! Auth::guest() && ( $article->author_id == Auth::user()->id ) )        
	        <span>
	        	<i class="glyphicon glyphicon-user"></i> by 
	        	<a href="{{ url('myindex') }}">
	        		You
	        	</a>
	        </span>
	    
	    	<li>|</li>
		    <form method="post" action="/articles/{{ $article->id }}" style="all:unset;" onsubmit="return ConfirmDelete()">
				<input name="_method" type="hidden" value="DELETE">									
				<input type="hidden" name="_token" value="{{ csrf_token() }}">	
			    <button type="submit" class="btn btn-danger btn-xs">
					<span class="glyphicon glyphicon-trash"></span> Delete?
			 	</button> 
			</form>	
		@else
	        <span>
	        	<i class="glyphicon glyphicon-user"></i> by {{ $article->author->name }}
	        </span>      


		@endif    
			          
	</ul>		

	<article>

		{!! $article->text !!}
		
	</article>    

@stop