<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require("../vendor/autoload.php");

$app = new \Slim\App;

$app->get(
  "/categories/",
  function(Request $req, Response $resp, $args){
    $resp->getBody()->write();
    return $resp;
  }
);

$app->run();
