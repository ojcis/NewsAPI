<?php

namespace App\Controllers;

use App\Models\Collections\NewsCollection;
use App\Template;

class NewsController
{
    public function index(): Template
    {
        if ($_GET['logout']){
            unset($_SESSION['user']);
        }

        if ($_GET['home']){
            return new Template('index.twig', [
                'user'=> $_SESSION['user']
            ]);
        }

        $search=$_GET['search'];
        if ($_GET['search']) {
            $news = new NewsCollection($search);
            return new Template('index.twig', [
                'news' => $news->getNewsCollection(),
                'search' => $search,
                'user' => $_SESSION['user'],
                'count' => count($news->getNewsCollection())
            ]);
        }

        return new Template('index.twig', [
            'user'=> $_SESSION['user']
        ]);
    }
}
