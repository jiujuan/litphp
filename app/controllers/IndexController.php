<?php

namespace app\controllers;

use app\models\Article;

class IndexController extends BaseController
{
    public function Index() {
        echo "hello , IndexController";
    }

    public function getArticle() {
        $article = Article::First();
        print_r($article);
    }
}
