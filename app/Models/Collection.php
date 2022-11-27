<?php

namespace App\Models;

require_once 'vendor/autoload.php';

use jcobhams\NewsApi\NewsApi;
use jcobhams\NewsApi\NewsApiException;

class Collection
{
    public function getCollection(string $search, int $size)
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

        $articleCollection = [];

        foreach ($articlesResponse->articles as $article) {
            $articleCollection[] = new Article(
                $article->author,
                $article->title,
                $article->description,
                $article->url,
                $article->urlToImage
            );
        }

        return $articleCollection;
    }
}