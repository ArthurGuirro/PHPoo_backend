<?php 

use app\core\Router;
use Dotenv\Dotenv;

require '../vendor/autoload.php';

session_start();

$dotenv = Dotenv::createImmutable('../');
$dotenv->load();

//var_dump(RequestType::get());
//var_dump(Uri::get());
//echo  '';
//dd($_SERVER);


Router::run();

?>