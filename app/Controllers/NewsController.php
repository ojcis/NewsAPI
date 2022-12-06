<?php

namespace App\Controllers;

use App\Models\Collections\NewsCollection;
use App\Template;

class NewsController
{
    public function index(): Template
    {
        $logout=$_GET['logout'] ?? null;
        $home=$_GET['home'] ?? null;

        if ($logout){
            unset($_SESSION['userId']);
            unset($_SESSION['userName']);
        }

        if ($home){
            return new Template('index.twig', [
                'userName'=> $_SESSION['userName']
            ]);
        }

        $search=$_GET['search'] ?? null;
        if ($search) {
            $news = new NewsCollection($search);
            return new Template('index.twig', [
                'news' => $news->getNewsCollection(),
                'search' => $search,
                'userName' => $_SESSION['userName'],
                'count' => count($news->getNewsCollection())
            ]);
        }

        return new Template('index.twig', [
            'userName'=> $_SESSION['userName']
        ]);
    }
}
