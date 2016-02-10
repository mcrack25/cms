<?php

/* Контроллер работающий с новостями */

class NewsController extends ASiteController
{
    public function action_All($page=1){
        echo 'Это страница со списком всех новостей по страницам, текущая страница = ' . $page;
    }

    public function action_One($id){
        echo 'Это страница с одной полной новостью, у которой id = ' . $id;
    }

}