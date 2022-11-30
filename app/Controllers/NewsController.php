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
            return new Template('index.twig', [
                'news' => $news->getNewsCollection(),
                'search' => $search
            ]);
        }
        return new Template('search.twig');
    }
}
