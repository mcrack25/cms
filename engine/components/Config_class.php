<?php

/*  Класс конфигураций, управляет конфигами сайта и базы данных  */

class Config {

    private static function getDir() {
        return Dirs::get('configs');
    }

    private static function selectConfig($name) {
        $dir_config = self::getDir();
        return $dir_config . $name;
    }

    private static function getMass($file_patch, $name) {

        if (file_exists($file_patch)) {
            $config_file = file_get_contents($file_patch);
            $json = json_decode($config_file, true);

            if (!empty($json[$name])) {
                return $json[$name];
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public static function getSite($name) {
        $file_patch = self::selectConfig('/site_config.php');
        return self::getMass($file_patch, $name);
    }

    public static function getAdmin($name) {
        $file_patch = self::selectConfig('/admin_config.php');
        return self::getMass($file_patch, $name);
    }

    public static function getAll($name) {
        $file_patch = self::selectConfig('/all_config.php');
        return self::getMass($file_patch, $name);
    }

    public static function getBase($name) {
        $file_patch = self::selectConfig('/base_config.php');
        return self::getMass($file_patch, $name);
    }

    public static function getModules_on_off($name) {
        $file_patch = self::selectConfig('/modules_on_off.php');
        return self::getMass($file_patch, $name);
    }

}