<?php
namespace site\model;

class RecipeMother{
    public $id_recette;
    public $titre;
    public $difficulte;
    public $duree;
    public $cout;
    public $ingredients;
    public $description_recette;
    public $etapes;
    public $date_publication;
    public $personnes;
    public $visible;
    public $photo_recette;
    public $nom_cuisinier;
    public $prenom_cuisinier;




    // **********GETTER D'INFORMATIONS DE RECETTE*********
    public function getId_recette() {
        return $this->id_recette;
    }
    public function getTitre() {
        return $this->titre;
    }
    public function getDifficulte() {
        return $this->difficulte;
    }
    public function getDuree() {
        return $this->duree;
    }
    public function getCout() {
        return $this->cout;
    }
    public function getIngredients() {
        return $this->ingredients;
    }
    public function getDescription_recette() {
        return $this->description_recette;
    }
    public function getEtapes() {
        return $this->etapes;
    }
    public function getDate_publication() {
        return $this->date_publication;
    }
    public function getPersonnes() {
        return $this->personnes;
    }
    public function getVisible() {
        return $this->visible;
    }
    public function getCuisinier() {
        return $this->cuisinier;
    }

    //////////////////////////////////////////////////////
    // **********SETTER D'INFORMATIONS DE RECETTE*********
    public function setId_recette($id_recette) {
        if($id_recette > 0) {
            $this->id_recette = $id_recette;
        }
    }
    public function setTitre($titre) {
        if(is_string($titre)) {
            $data = filter_var($titre, FILTER_SANITIZE_STRING);
            $cleanData = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->titre = $cleanData;
        }
    }
    public function setDifficulte($difficulte) {
        if(is_numeric($difficulte)) {
            $this->difficulte = $difficulte;
        }
    }
    public function setDuree($duree) {
        if(is_numeric($duree)) {
            $this->duree = $duree;
        }
    }
    public function setCout($cout) {
        if(is_numeric($cout)) {
            $this->cout = $cout;
        }
    }
    public function setIngredients($ingredients) {
        if(is_string($ingredients)) {
            $data = filter_var($ingredients, FILTER_SANITIZE_STRING);
            $cleanData = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->ingredients = $cleanData;
        }
    }
    public function setDescription_recette($description_recette) {
        if(is_string($description_recette)) {
            $data = filter_var($description_recette, FILTER_SANITIZE_STRING);
            $cleanData = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->description_recette = $cleanData;
        }
    }
    public function setEtapes($etapes) {
        if(is_string($etapes)) {
            $data = filter_var($etapes, FILTER_SANITIZE_STRING);
            $cleanData = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->etapes = $cleanData;
        }
    }
    public function setDate_publication($date_publication) {
        if(is_string($date_publication)) {
            $this->date_publication = $date_publication;
        }
    }
    public function setPersonnes($personnes) {
        if(is_numeric($personnes)) {
            $this->personnes = $personnes;
        }
    }
    public function setVisible($visible) {
        if(is_numeric($visible)) {
            $this->visible = $visible;
        }
    }
    public function setCuisinier($cuisinier) {
        if(is_numeric($cuisinier)) {
            $this->cuisinier = $cuisinier;
        }
    }
}