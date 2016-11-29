<?php

namespace src\controllers;

use src\models\Categorie as Categorie;
use src\models\Ingredient as Ingredient;

class CategorieController extends AbstractController{

  private $request = null;
  private $auth;

  public function __construct(HttpRequest $http_req){
    $this->request = $http_req;
    $this->auth = new Authentification();
  }

  static public function listCategories(){
    $nb_categories = Categorie::count();
    $categories = Categorie::select("id", "nom")->get();
    $chaine = [
                "nb" => $nb_categories,
                "categories" => $categories
              ];
    return $chaine;
  }

  static public function ingredientsByCategorie($id){
    $ingredients = Ingredient::where("cat_id", $id)->get();
    return $ingredients;
  }

}
