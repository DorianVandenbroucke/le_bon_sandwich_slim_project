<?php

header("Content-Type: application/json");

require("../vendor/autoload.php");
src\utils\AppInit::bootEloquent('../conf/conf.ini');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use src\controllers\CategorieController as CategorieController;

$app = new \Slim\App;

$app->get(
  "/categories/",
  function(Request $req, Response $resp, $args){
    $chaine = CategorieController::listCategories();
    $resp->getBody()->write(json_encode($chaine));
    return $resp;
  }
);

$app->run();
