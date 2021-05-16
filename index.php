<?php
//echo "<pre>";
//define('WEBROOT',dirname(__FILE__)); 
//define('ROOT', __FILE__);
//die(ROOT);
define('DS', DIRECTORY_SEPARATOR);
define('CORE',__FILE__.DS.'Core');
define('BASE_URL',dirname(dirname($_SERVER['SCRIPT_NAME'])));

define('BASE_URI', str_replace('\\', '/', substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT']))));
require_once(implode(DIRECTORY_SEPARATOR , ['Core', 'Autoload.php']));
$app = new Core\Core();
$app -> run();



//var_dump($_POST);
//var_dump($_GET);
//var_dump($_SERVER);
//echo "</pre>";
