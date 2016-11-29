<?php

require("../vendor/autoload.php");
src\utils\AppInit::bootEloquent('../conf/conf.ini');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use src\controllers\CategorieController as CategorieController;

$app = new \Slim\App;

$app->get(
  "/categories[/]",
  function(Request $req, Response $resp, $args){
    $chaine = CategorieController::listCategories();
    $resp = $resp->withStatus(200)->withHeader('Content-type', 'application/json, charset=utf-8');
    $resp->getBody()->write(json_encode($chaine));
    return $resp;
  }
);

$app->get(
  "/categories/{id}",
  function(Request $req, Response $resp, $args){
    try{
      $id = $args['id'];
      $chaine = CategorieController::ingredientsByCategorie($id);
      $resp = $resp->withStatus(200)->withHeader('Content-type', 'application/json, charset=utf-8');
      $resp->getBody()->write(json_encode($chaine));
    }catch(Illuminate\Database\Eloquent\ModelNotFoundException $e){
      $chaine = ["erreur", "Categorie introuvable"];
      $resp = $resp->withStatus(404)->withHeader('Content-type', 'application/json, charset=utf-8');
      $resp->getBody()->write(json_encode($chaine));
    }
    return $resp;
  }
);

$app->post(
  "/categories/add/",
  function(Request $req, Response $resp, $args){
    try{
      $chaine = CategorieController::addCategorie();
      $resp = $resp->withStatus(200)->withHeader('Content-type', 'application/json, charset=utf-8');
      $resp->getBody()->write(json_encode($chaine));
    }catch(Illuminate\Database\Eloquent\ModelNotFoundException $e){
      $chaine = ["erreur", "Une erreur survenue"];
      $resp = $resp->withStatus(404)->withHeader('Content-type', 'application/json, charset=utf-8');
      $resp->getBody()->write(json_encode($chaine));
    }
  }
);

$app->run();
