<?php

/* Контроллер работающий с новостями */

class NewsController extends ASiteController
{
    public function action_All($page){
        $news = NewsModel::findAllOnPage($page, Config::getSite('news_on_page'), ['active'=>1], ['id'=>'DESC']);
        $count_news = NewsModel::$count_items;
        echo $count_news;
        echo '<pre>';
        var_dump($news);
        echo '</pre>';
    }

    public function action_One($id){
        $article = NewsModel::findOneByPk($id);
        if(!empty($article)){
            //....
        }

    }

}