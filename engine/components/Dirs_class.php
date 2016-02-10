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
            'components' => $mass['engine'] . '/components',
            'configs' => $mass['engine'] . '/configs',
            'acontrollers' => $mass['engine'] . '/acontrollers',
            'controllers' => $mass['engine'] . '/controllers',
            'models' => $mass['engine'] . '/models',
            'views' => $mass['engine'] . '/views',
        ];

        $mass += [
            'error404' => $mass['templates_system'] . '/error404',
            'system_site' => $mass['templates_system'] . '/site',
            'system_admin' => $mass['templates_system'] . '/admin',
            'banners' => $mass['templates_system'] . '/banners',
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
            'url_error404' => $mass['url_templates_system'] . '/error404',
            'url_system_site' => $mass['url_templates_system'] . '/site',
            'url_system_admin' => $mass['url_templates_system'] . '/admin',
            'url_banners' => $mass['url_templates_system'] . '/banners',
        ];

        return $mass;
    }

}