<?php

namespace App;

use jcobhams\NewsApi\NewsApi;
use App\Models\News;

class NewsCollection
{
    private array $newsCollection;

    public function __construct(string $search)
    {
        $allNews=(new NewsApi($_ENV['API_KEY']))->getEverything($search,null,null,null,null,null,'en',null,10);
        foreach ($allNews->articles as $article){
            $this->newsCollection[]=new News($article->title, $article->description, $article->url);
        }
    }

    public function getNewsCollection(): array
    {
        return $this->newsCollection;
    }
}