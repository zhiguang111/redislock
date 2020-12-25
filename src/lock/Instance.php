<?php
namespace lock\Instance;

class Instance
{
    private static $getInstance;

    private function __construct(){}

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function getInstance ($class)
    {
        if (self::$getInstance instanceof $class) {
            self::$getInstance = new $class();
        }

        return self::$getInstance;
    }


}