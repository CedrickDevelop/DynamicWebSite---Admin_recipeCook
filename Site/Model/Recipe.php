<?php
namespace site\model;

class Recipe extends RecipeMother {

	
	public function __construct($id_recette, $titre, $difficulte, $duree, $cout,
                                $ingredients, $description_recette,	$etapes,
                                $personnes, $visible, $photo_recette, $nom_cuisinier, $prenom_cuisinier){

        $this->id_recette = $id_recette;
        $this->titre = $titre;
        $this->difficulte = $difficulte;
        $this->duree = $duree;
        $this->cout = $cout;
        $this->ingredients = $ingredients;
        $this->description_recette = $description_recette;
        $this->etapes = $etapes;
        $this->personnes = $personnes;
        $this->visible = $visible;
        $this->nom_cuisinier = $nom_cuisinier;
        $this->prenom_cuisinier = $prenom_cuisinier;
        $this->photo_recette = $photo_recette;

	}


}