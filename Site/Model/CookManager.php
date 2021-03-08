<?php
namespace site\model;
use PDO;

class CookManager {
	public $id_recette;
	public $titre;
	public $nombre = [];



/*************** LE NOMBRE DE CUISINIERS ***************/
/**********************************************************/
	public function NombreCuisinier(){
		$requete = $this->Connexion()->query('SELECT COUNT(*) FROM cuisinier');
		$nombreCuisinier = $requete ->fetch(PDO::FETCH_ASSOC);
		return $nombreCuisinier;
	}

/*************** AFFICHER TOUS LES CUISINIERS ***************
 * *******************************************************/	
	public function ReadAllCook() {
		$requete = $this->Connexion()->query('SELECT * FROM cuisinier');
		$data = $requete ->fetchAll(PDO::FETCH_OBJ);
		$nb = $this->NombreCuisinier();
    //SETTER CONNECTES A RECIPE ENTITE
		foreach ($data as $datas){
			$id_cuisinier = $datas->id_cuisinier;
			$nom = $datas->nom;
			$prenom = $datas->prenom;
			$photo = $datas->photoCuisto;
			$date_inscription = $datas->date_inscription;
			// Instancie nouvel objet envoyé à entite home
			$cooks[] = new Cook($id_cuisinier, $nom, $prenom, $photo);
		}
		return $cooks;

	}
    /*************** CREER UN CUISINIER ***************
	****************************************************/
    public function CreateACook(CookMother $data){
        // Variables à inserer dans les get
        $date = date("d.m.y, g:i a");

        // Definir les infos de la photo
        $photo = $data->photo;
        //$photo_ext = strtolower(substr($photo['type'], -3));
        $nom = $data->nom;
        $prenom = $data->prenom;
        $photo_name= $prenom. '_' .$nom ;
        //$photo_name= $prenom. '_' .$nom. '.' .$photo_ext ;

        // Transfert photo cuisinier
        //$dossier ;
        //move_uploaded_file($photo['tmp_name'], $dossier.basename($photo_name));

        // Connexion et bindvalue
        $cnx = $this->Connexion();
        $sql = 'INSERT INTO cuisinier (nom, prenom, photoCuisto, date_inscription) 
						VALUES (:nom, :prenom, :photo, :date_inscription)';
        $rs_createCook = $cnx->prepare($sql);
        $rs_createCook->bindValue(':nom', $data->getNom(), PDO::PARAM_STR);
        $rs_createCook->bindValue(':prenom', $data->getPrenom(), PDO::PARAM_STR);
        $rs_createCook->bindValue(':photo', $photo_name, PDO::PARAM_STR);
        $rs_createCook->bindValue(':date_inscription', $date, PDO::PARAM_STR);
        $rs_createCook->execute();
    }
    public function getMsgFailedCreateACook() {
        $msg = '<p class="message_formulaire_failed"><i>* Tous les champs sont obligatoires</i></p>';
        return $msg;
    }

    public function getMsgSuccesCreateACook() {
        $msg = '<p class="message_formulaire_succes> Le nouveau cuisinier a bien été créé !</p>';
        return $msg;
    }

/*************** CONNEXION A LA BDD ***************/	
private function Connexion(){
    $cnx = new PDO('mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8', ''.CNX_LOGIN.'', ''.CNX_PASS.'');
    $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->cnx = $cnx;
    return $this->cnx;
}	

}