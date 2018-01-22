<?php

namespace App\Feed;

use Illuminate\Support\Facades\App;
use App\Article;


class FeedBuilder
{
    private $config;

    public function __construct()
    {
        $this->config = config()->get('feed');
    }

    public function render($type)
    {
        $feed = App::make("feed");		
        
        if ($this->config['use_cache']) {
            $feed->setCache($this->config['cache_duration'], $this->config['cache_key']);
        }

        if (!$feed->isCached()) {
            
            $articles = $this->getFeedData();
            
            $feed->title = $this->config['feed_title'];
            $feed->description = $this->config['feed_description'];
            $feed->logo = $this->config['feed_logo'];
            $feed->link = url('feed');
            $feed->setDateFormat('datetime');
            $feed->lang = 'en';
            $feed->setShortening(false);

           
            
            

            if (!empty($articles)) {
                
                $feed->pubdate = $articles[0]->created_at;
                
                foreach ($articles as $article) {
                    
                    $link =  url("/articles/" . $article->id);                               
                    
                    $author = $article->author->name;

                    $img = '<img src="/uploads/' . $article->thumbnail . '" alt="' . $article->name . '" width="150">';     
                    $summary = str_limit(strip_tags($article->text), $limit = 500, ' [...]');

                    $summary = $img . $summary;
                    
                    
                    // set item's title, author, url, pubdate, description, content, enclosure (optional)*
                    $feed->add($article->title, $author, $link, $article->created_at, $summary);
                   
                }
            }
        }

        return $feed->render($type);
    }

    /**
     * Creating rss feed with our most recent posts. 
     * The size of the feed is defined in feed.php config.
     *
     * @return mixed
     */
    private function getFeedData()
    {
        $maxSize = $this->config['max_size'];

        $articles = Article::orderBy('created_at', 'desc')
                            ->take($maxSize)
                            ->get();
        
        return $articles;
    }
}