<?php
namespace site\model;

class Cook extends CookMother {
	public $id_cuisinier;
    public $nom;
    public $prenom;
    public $photo;
    public $date_inscription;
    public $photoAdresse;

	public function __construct($id_cuisinier, $nom, $prenom, $photo){

		if(is_numeric($id_cuisinier)) {
			$this->id_cuisinier = $id_cuisinier;
		}
		if(is_string($nom)) {
			$this->nom = $nom;
		}
		if(is_string($prenom)) {
			$this->prenom = $prenom;
		}
		if(is_string($photo)) {
			$this->photo = $photo;
		}


	}

}