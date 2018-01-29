@if ( !$articles->count() )
    There is no article yet. Please login and be the one to write the first article!
@else

    @foreach( $articles as $article )
        <div class="well">
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="/uploads/{{ $article->thumbnail}}" alt="{{ $article->name}}" width="150">
                </a>

                <div class="media-body">
                    <h4 class="media-heading">
                        <a href="{{ url('/articles', [$article->id]) }}">{{ $article->title }}</a>
                    </h4>

                    {!! str_limit(strip_tags($article->body), $limit = 400, $end = '..... <a href='. url("/articles/" . $article->id).'>Read More</a>') !!}

                    <br /><br />

                    <ul class="list-inline list-unstyled">
                        <li>
			  				<span>
			  					<i class="glyphicon glyphicon-calendar"></i>
                                {{ $article->created_at->format('M d, Y h:i a')}}
			  				</span>
                        </li>

                        <li>|</li>

                        <a href="{{ url('pdf/' . $article->id) }}" target="_blank" style="text-decoration: none;">
                            <button type="button" class="btn btn-default btn-xs">
                                <span class="glyphicon glyphicon-save"></span> PDF
                            </button>
                        </a>

                        <li>|</li>

                        @if( ! Auth::guest() && ( $article->author_id == Auth::user()->id ) )

                            <span>
				            	<i class="glyphicon glyphicon-user"></i> by
				            	<a href="{{ url('myindex') }}">
				            		You
				            	</a>
				            </span>

                            <li>|</li>

                            <a href="{{ route('articles.edit', $article->id) }}" style="text-decoration: none">
                                <button type="button" class="btn btn-default btn-xs">
                                    <i class="glyphicon glyphicon-edit"></i> Edit
                                </button>
                            </a>

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

                </div>
            </div>

        </div>

    @endforeach

@endif