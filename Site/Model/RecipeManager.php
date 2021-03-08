<?php
namespace site\model;
use PDO;

class RecipeManager {
	private $pdo;
	public $titre;

/*************** AFFICHER L'ARTICLE DEMANDE ***************/	
	public function ReadARecipe($id_recette) {
		$requete = $this->Connexion();
		$sql = 'SELECT * FROM recette
				WHERE id_recette = :id_recette';
		$rs_readARecipe = $requete->prepare($sql);
        $rs_readARecipe->bindValue(':id_recette', $id_recette, PDO::PARAM_INT);
        $rs_readARecipe->execute();
		$datas = $rs_readARecipe->fetch(PDO::FETCH_OBJ);
		
		/////////
		$id_recette = $datas->id_recette;
		$titre = $datas->titre;
		$difficulte = $datas->difficulte;
		$duree = $datas->duree;
		$cout = $datas->cout;
		$ingredients = $datas->ingredients;
		$description_recette = $datas->description_recette;
		$etapes = $datas->etapes;
		$date_publication = $datas->date_publication;
		$personnes = $datas->personnes;
		$visible = $datas->visible;
		$cuisinier = $datas->cuisinier;
		////////////
		$recipes = new Recipe($id_recette,$titre, $difficulte, $duree, $cout, $ingredients, $description_recette,	$etapes, $personnes, $visible);
		
		return $recipes;
	}

/*************** LE NOMBRE DE RECETTES **********************/
	public function NombreRecette(){
		$requete = $this->Connexion()->query('SELECT COUNT(id_recette) FROM recette');
		$nb = $requete ->fetch(PDO::FETCH_NUM);
		//$nombreRecetteshasard = random_int(0, $nb[0]-1);
		return $nb;


	}

/*************** AFFICHER TOUTES LES RECETTES ***************/
	public function ReadAllRecipe() {
		$requete = $this->Connexion()->query('SELECT * FROM recette LEFT JOIN cuisinier
                                            ON recette.id_cuisinier = cuisinier.id_cuisinier');
		$datas = $requete ->fetchAll(PDO::FETCH_OBJ);
		$nb = $this->NombreRecette();
        var_dump($nb);

    //SETTER CONNECTES A RECIPE ENTITE
		for ($i = 0; $i< ($nb[0]); $i++){
			$id_recette[$i] = $datas[$i]->id_recette;
			$titre[$i] = $datas[$i]->titre;
			$difficulte[$i] = $datas[$i]->difficulte;
			$duree[$i] = $datas[$i]->duree;
			$cout[$i] = $datas[$i]->cout;
			$ingredients[$i] = $datas[$i]->ingredients;
			$description_recette[$i] = $datas[$i]->description_recette;
			$etapes[$i] = $datas[$i]->etapes;
			$date_publication[$i] = $datas[$i]->date_publication;
			$personnes[$i] = $datas[$i]->personnes;
			$visible[$i] = $datas[$i]->visible;
            $photo_recette[$i] = $datas[$i]->photo;
			$nom_cuisinier[$i] = $datas[$i]->nom;
			$prenom_cuisinier[$i] = $datas[$i]->prenom;
			// Instancie nouvel objet envoyé à entite Recipe
			$recipes = new Recipe($id_recette, $titre , $difficulte, $duree, $cout, $ingredients, $description_recette,
                $etapes, $personnes, $visible,$photo_recette, $nom_cuisinier, $prenom_cuisinier);
		}
		
		return $recipes;
	}	

/*************** CREER UNE RECETTE **************************/
    public function CreateARecipe(RecipeMother $data){
        // Variables à inserer dans les get
        $date = date("d.m.y, g:i a");
        //$cuisinier = 36;
        $like_recette = 1;
        $photo = 'Default.png';

        // Connexion et bindvalue
        $cnx = $this->Connexion();
        $sql = 'INSERT INTO recette (titre, difficulte, duree, cout, ingredients, description_recette,
                     etapes, date_publication, personnes, visible, photo, id_cuisinier, like_recette) 
						VALUES (:titre, :difficulte, :duree, :cout, :ingredients, :description_recette,
						        :etapes, :date_publication, :personnes, :visible, :photo, :id_cuisinier, :like_recette)';
        $rs_createRecipe = $cnx->prepare($sql);
        $rs_createRecipe->bindValue(':titre', $data->getTitre(), PDO::PARAM_STR);
        $rs_createRecipe->bindValue(':difficulte', $data->getDifficulte(), PDO::PARAM_INT);
        $rs_createRecipe->bindValue(':duree', $data->getDuree(), PDO::PARAM_INT);
        $rs_createRecipe->bindValue(':cout', $data->getCout(), PDO::PARAM_INT);
        $rs_createRecipe->bindValue(':ingredients', $data->getIngredients(), PDO::PARAM_STR);
        $rs_createRecipe->bindValue(':description_recette', $data->getDescription_recette(), PDO::PARAM_STR);
        $rs_createRecipe->bindValue(':etapes', $data->getEtapes(), PDO::PARAM_STR);
        $rs_createRecipe->bindValue(':date_publication', $date, PDO::PARAM_STR);
        $rs_createRecipe->bindValue(':personnes', $data->getPersonnes(), PDO::PARAM_INT);
        $rs_createRecipe->bindValue(':visible', $data->getVisible(), PDO::PARAM_INT);
        $rs_createRecipe->bindValue(':photo', $photo, PDO::PARAM_STR);
        $rs_createRecipe->bindValue(':id_cuisinier', $data->getCuisinier(), PDO::PARAM_INT);
        $rs_createRecipe->bindValue(':like_recette', $like_recette, PDO::PARAM_INT);
        $rs_createRecipe->execute();
    }
/*************** MESSAGE CREATION *********/
    public function getMsgFailedCreateARecipe() {
        $msg = '<p class="message_formulaire_failed"><i>* Tous les champs sont obligatoires</i></p>';
        return $msg;
    }
    public function getMsgSuccesCreateARecipe() {
        $msg = '<p class="message_formulaire_succes"> La nouvelle recette est créée !</p>';
        return $msg;
    }

/*************** MODIFICATION D'UNE RECETTE *****************/
	 public function UpdateARecipe(RecipeMother $datas) {
         // Variables à inserer dans les get
         $date = date("d.m.y, g:i a");

         // Connexion et bindvalue
	 	$cnx = $this->Connexion();
	 	$sql = 'UPDATE recette SET id_recette =:id_recette, titre =:titre, difficulte =:difficulte, duree =:duree, cout =:cout, 
                ingredients =:ingredients, description_recette =:description_recette, etapes =:etapes, 
                date_publication =:date_publication, personnes =:personnes, visible =:visible
	 		    WHERE id_recette =:id_recette';
         $rs_createRecipe = $cnx->prepare($sql);
         $rs_createRecipe->bindValue(':id_recette', $datas->getId_recette(), PDO::PARAM_STR);
         $rs_createRecipe->bindValue(':titre', $datas->getTitre(), PDO::PARAM_STR);
         $rs_createRecipe->bindValue(':difficulte', $datas->getDifficulte(), PDO::PARAM_INT);
         $rs_createRecipe->bindValue(':duree', $datas->getDuree(), PDO::PARAM_INT);
         $rs_createRecipe->bindValue(':cout', $datas->getCout(), PDO::PARAM_INT);
         $rs_createRecipe->bindValue(':ingredients', $datas->getIngredients(), PDO::PARAM_STR);
         $rs_createRecipe->bindValue(':description_recette', $datas->getDescription_recette(), PDO::PARAM_STR);
         $rs_createRecipe->bindValue(':etapes', $datas->getEtapes(), PDO::PARAM_STR);
         $rs_createRecipe->bindValue(':date_publication', $date, PDO::PARAM_STR);
         $rs_createRecipe->bindValue(':personnes', $datas->getPersonnes(), PDO::PARAM_INT);
         $rs_createRecipe->bindValue(':visible', $datas->getVisible(), PDO::PARAM_INT);
         $rs_createRecipe->execute();
	 }
/*************** MESSAGE MODIFICATION D'UNE RECETTE *********/
    public function getMsgFailedUpdateARecipe() {
        $msg = '<p class="message_formulaire_failed"><i>* Tous les champs sont obligatoires</i></p>';
        return $msg;
    }
    public function getMsgSuccesUpdateARecipe() {
	 	$msg = '<p class="message_formulaire_succes">La recette a été mise à jour !</p>';
	 	return $msg;
	 }

    /*************** MODIFICATION D'UNE RECETTE *****************/
    public function DeleteARecipe(RecipeMother $data) {
        // Connexion et bindvalue
        $cnx = $this->Connexion();
        $sql = 'DELETE FROM recette  WHERE id_recette =:id_recette';
        $rs_createRecipe = $cnx->prepare($sql);
        $rs_createRecipe->bindValue(':id_recette', $data->getId_recette(), PDO::PARAM_INT);
        $rs_createRecipe->execute();
    }
    /*************** MESSAGE MODIFICATION D'UNE RECETTE *********/
    public function getMsgWarnDeleteARecipe() {
        $msg = '<p class="message_formulaire_failed"><i>* Attention, toute suppression est irréversible !!</i></p>';
        return $msg;
    }
    public function getMsgSuccesDeleteARecipe() {
        $msg = '<p class="message_formulaire_succes">La recette a bien été supprimée !</p>';
        return $msg;
    }





/*************** CONNEXION A LA BDD ***************/	
    /*private function Connexion(){
        if ($this->pdo === null){
            try {
                $cnx = new PDO('mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8', ''.CNX_LOGIN.'', ''.CNX_PASS.'');
                $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->cnx = $cnx;
            } catch (Throwable $t){
                echo 'Problème erreur '.$t->getMessage();
            } catch (Exception $e){
                echo 'Problème exception'.$e->getMessage();
            }
        }

        return $this->cnx;

    }*/
    private function Connexion(){

        if ($this->pdo === null){
            try {
                $cnx = new PDO('mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8', ''.CNX_LOGIN.'', ''.CNX_PASS.'');
                $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->cnx = $cnx;
            } catch (Throwable $t){
                echo 'Problème erreur '.$t->getMessage();
            } catch (Exception $e){
                echo 'Problème exception'.$e->getMessage();
            }
        }
        return $this->cnx;
    }


}