<?php

class Autoload
{
    public static function inclusion($classname)
    {
        require_once __DIR__.'/'.str_replace('\\', '/', $classname. '.php');

        //echo"require_once __DIR__.'/'.str_replace('\\', '/', $classname. '.php');";
    }

}

spl_autoload_register(array('Autoload', 'inclusion'));