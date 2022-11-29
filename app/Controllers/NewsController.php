<?php

namespace App\Controllers;


use App\NewsCollection;
use App\Template;

class NewsController
{
    public function index(): Template
    {
        $search=$_GET['search'];
        if ($search) {
            $news = new NewsCollection($search);
            return new Template('index.html.twig', [
                'news' => $news->getNewsCollection(),
                'search' => $search
            ]);
        }else{
            return new Template('search.html.twig');
        }
    }
}
