<?php

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$news = new \App\Models\Collection();
echo "<pre>";
var_dump($news->getCollection('nhl', 10));
