<?php

class Config {
    public static function DB_HOST(){
        return 'bemytechdatabase-do-user-14134438-0.b.db.ondigitalocean.com';
    }
    public static function DB_USERNAME(){
        return 'doadmin';
    }
    public static function DB_PASSWORD(){
        return 'AVNS_Ot2MkCETgIvlUt4B0TD';
    }
    public static function DB_SCHEMA(){
        return 'defaultdb';
    }
    public static function DB_PORT(){
        return '25060';
    }

    public static function JWT_SECRET(){
        return Config::get_env("JWT_SECRET","BeMyTech");
      }
      public static function get_env($name, $default){
        return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
      }
}

?>