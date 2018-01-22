<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Feed\FeedBuilder;

class FeedController extends Controller
{
    private $builder;

    public function __construct(FeedBuilder $builder)
    {
        $this->builder = $builder;
    }

    //Atom is the default type
    public function getFeed($type = "atom")
    {
        if ($type === "rss" || $type === "atom") {
            return $this->builder->render($type);
        }
        
        //If invalid feed requested, redirect home
        return redirect()->home();
    }
}