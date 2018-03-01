<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use Image;
use File;
use Auth;
use PDF;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $articles = Article::orderBy('created_at', 'desc')
                            ->take(10)
                            ->get();
       return view('articles.index')->with( 'articles', $articles );
        //return Article::first();
    }

    /**
     * Displays a list of user's news, once logged.
     *
     * @return \Illuminate\Http\Response
     */
    public function myindex()
    {
       
        if (Auth::guest()){

             return redirect()->route('home')
                              ->with('message', 'You have to be logged in to see Your News');
        } else {

            $articles = Article::where('author_id', Auth::user()->id)
                                ->orderBy('created_at', 'desc')                            
                                ->get(); 

            return view('articles.myindex')->with( 'articles', $articles );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {

        // Create a new Article Model initialization
        $article = new Article;

        $article->author_id = $request->author_id;
        $article->title     = $request->title;
        $article->body      = $request->body;

        // Checks if file is present
        if( $request->hasFile('thumbnail') ) {
            $thumbnail     = $request->file('thumbnail');
            $filename      = time() . '.' . $thumbnail->getClientOriginalExtension();
            
            Image::make($thumbnail)
                    ->resize(300, null, function ($constraint) { $constraint->aspectRatio(); })
                    ->save( public_path('uploads/' . $filename ) );

            // Set thumbnail url
            $article->thumbnail = $filename;
        }
        
        $article->save();
        
        // Store message in session data 
        session()->flash( 'message', 'Post published.' );

        // Redirect to `articles.show` route
        return redirect()->route('articles.show', $article->id);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
         
         return view('articles.show')->with('article', $article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);

        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());

        return redirect()->route('myindex');

    }

    /**
     * Display the pdf version of a resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        $article = Article::find($id);
      
        $data = array( 
            'article' => $article,             
        );

        $pdf = PDF::loadView('pdf.plain', $data);        
        return $pdf->stream();  
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if ( $article->thumbnail){

            $file = public_path('uploads/' . $article->thumbnail );

            if (File::exists($file)) {
                    unlink($file);
            }
        } 

        $article->delete();

        return redirect()->route('articles.index')->with('message', 'You Have Deleted The News Item');
    }
}
