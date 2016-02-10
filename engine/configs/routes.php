<?php

/* Работает в паре с Router_class, содержит в себе все пути по которым будет идти перенапраление */

return [
    //Администраторская часть
    'admin/settings' => 'admin/settings',

    'admin/category/([0-9])' => 'admin/category/$1',
    'admin/category_list/page-([0-9])' => 'admin/category_list/1',
    'admin/category_list' => 'admin/category_list/1',

    'admin/add_article' => 'admin/add_article',
    'admin/edit_article/([0-9])' => 'admin/edit_article/$1',

    'admin/news_list/page-([0-9])' => 'admin/news_list/$1',
    'admin/news_list' => 'admin/news_list/1',
    'admin' => 'admin/index',


    //Фронтальная часть

    //Новостная лента фильтр новостей
    'filter' => 'site/list_filter/1',
    'filter/page-([0-9]+)' => 'site/list_filter/$1',
    //Новостная лента тегов
    'tags/([a-zA-Z0-9_-]+)/page-([0-9]+)' => 'site/list_tag/$1/$2',
    'tags/([a-zA-Z0-9_-]+)' => 'site/list_tag/$1/1',
    //Новостная лента поиска
    'search/([a-zA-Z0-9_-]+)/page-([0-9]+)' => 'site/list_search/$1/$2',
    'search/([a-zA-Z0-9_-]+)' => 'site/list_search/$1/1',
    //Страница пользователя
    'user/([0-9]+)' => 'users/show',
    //Страница обратной связи
    'feedback' => 'feedback/page',
    // Новостная лента по категориям
    'category/([0-9]+)\-[a-zA-Z0-9_-]+/page-([0-9]+)' => 'site/list_category/$1/$2',
    'category/([0-9]+)\-[a-zA-Z0-9_-]+' => 'site/list_category/$1/1',
    //Новостная лента на главной со страницами
    'page-([0-9]+)' => 'News/All/$1',
    //Конкретная новость
    '([0-9]+)-[a-zA-Z0-9_-]+' => 'News/One/$1',
    //Новостная лента на главной
    '' => 'News/All/1',

    // Страница ошибки 404 Страница не найдена
    '(.*)' => 'error/404',

];