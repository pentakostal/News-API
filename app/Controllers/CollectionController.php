<?php

 namespace App\Controllers;

 use App\Models\Article;
 use jcobhams\NewsApi\NewsApi;
 use Twig\Template;

 class CollectionController
{
    public function getCollection(?string $search = "NHL", ?int $size = 10): Template
    {
        $apiKey = $_ENV['SECRET_KEY'];

        $newsArticles = new NewsApi($apiKey);

        $articlesResponse = $newsArticles->getEverything($q = $search,
            $sources = null,
            $domains = null,
            $exclude_domains = "youtube.com",
            $from = null,
            $to = null,
            $language = 'en',
            $sort_by = null,
            $page_size = $size,
            $page = null);

        foreach ($articlesResponse->articles as $article) {
            $articles = new Article(
                $article->author,
                $article->title,
                $article->description,
                $article->url,
                $article->urlToImage
            );
        }

        return new Template()
        {
            $twig->render('../../views/home.twig', [
            "articleTitle" => $articles->getTitle(),
            "articleAthor" => $articles->getAuthor(),
            "articleDescription" => $articles->getDescription()
        ]);
    }
    }
 }