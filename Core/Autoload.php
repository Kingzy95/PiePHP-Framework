<?php

namespace Core;

class Autoload
{
    /**
     * On met la fonction en static parce que l'on a pas besoin d'instancier notre classe
     */
	static function register()
    {
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}

    /**
     * @param $class
     */
	static function autoload($class)
    {
		$path = str_replace('\\', DIRECTORY_SEPARATOR, $class);

		if(is_file($path.".php"))
        {
			require_once($path . '.php');
		}
	}
}


Autoload::register();
