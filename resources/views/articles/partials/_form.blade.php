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
    {{ Form::label( 'published_at', 'Publish On:' ) }}
    {{ Form::date('published_at', \Carbon\Carbon::now()) }}
</div>

<div class="form-group">
    {{ Form::label( 'body', 'News Item Text' ) }}
    {{ Form::textarea( 'body', $article->body, ['class' => 'form-control'] ) }}
</div>

<div class="form-group">
    {{ Form::submit( $submitButtonText, ['class' => 'btn btn-success btn-block'] ) }}
</div>