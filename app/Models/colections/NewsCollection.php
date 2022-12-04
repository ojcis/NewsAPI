<?php

namespace App\Models\colections;

use App\Models\News;
use jcobhams\NewsApi\NewsApi;

class NewsCollection
{
    private array $newsCollection;

    public function __construct(string $search)
    {
        $allNews=(new NewsApi($_ENV['API_KEY']))->getEverything($search);
        foreach ($allNews->articles as $article){
            $img=$article->urlToImage;
            if (! $img){
                $img='https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg';
            }
            $this->newsCollection[]=new News($article->title, $article->description, $article->url, $img);
        }
    }
    public function getNewsCollection(): array
    {
        return $this->newsCollection;
    }
}