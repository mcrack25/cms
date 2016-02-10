<?php

/* Файл, содержащий в себе все пути к папкам и URL'ы статических папок */

class Dirs {

    public static function get($name) {
        $mass = self::mass();
        return $mass[$name];
    }

    private static function mass() {

        //PHP Адреса директорий
        $mass = [
            'engine' => ROOT_DIR . '/engine',
            'templates' => ROOT_DIR . '/templates',
            'templates_admin' => ROOT_DIR . '/templates_admin',
            'templates_system' => ROOT_DIR . '/templates_system',
            'sqlite_db' => ROOT_DIR . '/db',
            'uploads' => ROOT_DIR . '/uploads',
            'design' => ROOT_DIR . '/design',
            'cache' => ROOT_DIR . '/cache',
            'modules' => ROOT_DIR . '/modules',
        ];

        $mass += [
            'components' => $tpl['engine'] . '/components',
            'configs' => $tpl['engine'] . '/configs',
            'acontrollers' => $tpl['engine'] . '/acontrollers',
            'controllers' => $tpl['engine'] . '/controllers',
            'models' => $tpl['engine'] . '/models',
            'views' => $tpl['engine'] . '/views',
        ];

        $mass += [
            'error404' => $tpl['templates_system'] . '/error404',
            'system_site' => $tpl['templates_system'] . '/site',
            'system_admin' => $tpl['templates_system'] . '/admin',
            'banners' => $tpl['templates_system'] . '/banners',
        ];

        //URL Адреса директорий
        $mass += [
            'url_engine' => '/engine',
            'url_templates' => '/templates',
            'url_templates_admin' => '/templates_admin',
            'url_templates_system' => '/templates_system',
            'url_sqlite_db' => '/db',
            'url_uploads' => '/uploads',
            'url_design' => '/design',
        ];

        $mass += [
            'url_error404' => $tpl['url_templates_system'] . '/error404',
            'url_system_site' => $tpl['url_templates_system'] . '/site',
            'url_system_admin' => $tpl['url_templates_system'] . '/admin',
            'url_banners' => $tpl['url_templates_system'] . '/banners',
        ];

        return $mass;
    }

}