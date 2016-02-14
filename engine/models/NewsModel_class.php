<?php
/**
 * Class NewsModel
 * Класс для работы с таблицей новостей
 * @property $id
 * @property $title
 * @property $keywords
 * @property $description
 * @property $name
 * @property $shortstory
 * @property $fullstory
 * @property $active
 */
class NewsModel
    extends AModels
{
    protected static $project = 'cms';
    protected static $table = 'news';

}