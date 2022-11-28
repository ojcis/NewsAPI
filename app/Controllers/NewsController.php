<?php

namespace App\Controllers;


use App\NewsCollection;
use App\Template;

class NewsController
{
    public function index(): Template
    {
        $news= new NewsCollection($_GET['search'] ?? 'Covid');
        return new Template('index.html.twig', ['news'=>$news->getNewsCollection()]);
    }
}
