<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $fillable= [ 'title', 'text' ];


    // returns the instance of the user who is author of that article
    public function author()
    {
        return $this->belongsTo('App\User','author_id');
    }
}
