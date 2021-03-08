<?php

namespace site\controller;

use classe;
use site\model as sm;


class Accueil
{
    /*************** AFFICHER LOGIN ***************/
    public function AfficherLogin()
    {
        if ((empty($_POST['pseudo'])) || (empty($_POST['password']))) {
            $manager = new sm\AdminManager();
            $message = $manager->getMsgVide();
            $view = new classe\View_home('Site/View', 'Login', 'Connexion', 'La page de connexion');
            $view->AfficherVue(array(
                'message' => $message,
                'dossier' => 'Site/view',
                'fichier' => 'Login'));
        } else {
            $manager = new sm\AdminManager();
            $membre = $manager->ReadMembre($_POST['pseudo'], $_POST['password']);
            if (($membre->getPseudo() == $_POST['pseudo']) and ($membre->getPassword() == $_POST['password'])) {
                $_SESSION['pseudo'] = $_POST['pseudo'];
                $this->AfficherHome();
            } else {
                $manager = new sm\AdminManager();
                $message = $manager->getMsgErreur();
                $view = new classe\View_home('Site/View', 'Login', 'Connexion', 'La page de connexion');
                $view->AfficherVue(array(
                    'message' => $message,
                    'dossier' => 'Site/view',
                    'fichier' => 'Login'));
            }
        }
    }

    /*************** AFFICHER TOUTES LES RECETTES ET CUISINIERS ***************/
    public function AfficherHome()
    {
        $manager = new sm\CookManager();
        $nbCook = $manager->NombreCuisinier();

        $view = new classe\View_home('Site/View', 'Home', 'Deconnexion', 'La page de déconnexion');
        $view->AfficherVue(array(
            'dossier' => 'Site/View',
            'fichier' => 'Home'));
    }

    /*************** SE DECONNECTER***************/
    public function seDeconnecter()
    {
        $view = new classe\View_home('Site/View', 'Logout', 'Deconnexion', 'La page de déconnexion');
        $view->AfficherVue(array(
            'dossier' => 'Site/view',
            'fichier' => 'Logout'));
    }

    /*************** CREATE COOK ***************/
    public function CreateCook()
    {
        if ((!empty($_POST['nom_cuisinier'])) && (!empty($_POST['prenom_cuisinier']))) {
            $data = new sm\CookMother();
            $data->setNom($_POST['nom_cuisinier']);$data->setPrenom($_POST['prenom_cuisinier']);

            $manager = new sm\CookManager();
            $manager->CreateACook($data);
            $message = $manager->getMsgSuccesCreateACook();

            $view = new classe\View_home('Site/View', 'cookCreate', 'Connexion', 'La page de connexion');
            $view->AfficherVue(array(
                'message' => $message,
                'dossier' => 'Site/view',
                'fichier' => 'cookCreate'));
        } else {
            $manager = new sm\CookManager();
            $message = $manager->getMsgFailedCreateACook();
            $view = new classe\View_home('Site/View', 'cookCreate', 'Creer un cuisinier', 'La page de création de cuisinier');
            $view->AfficherVue(array(
                'message' => $message,
                'dossier' => 'Site/view',
                'fichier' => 'cookCreate'));
        }
    }

    /*************** CREATE RECIPE ***************/
    public function CreateRecipe() {

        /////////////////////////SI DES CHAMPS SONT VIDES///////////////////////////

        if ((empty($_POST['titre'])) || (empty($_POST['ingredients'])) || (empty($_POST['description_recette'])) ||
            (empty($_POST['etapes'])) || (empty($_POST['cuisinier']))) {
            // Message d'erreur
            $manager = new sm\RecipeManager();
            $message = $manager->getMsgFailedCreateARecipe();

            // Chargement des cuisiniers
            $manager = new sm\CookManager();
            $cook = $manager->ReadAllCook();
            $nbCook = $manager->NombreCuisinier();

            $view = new classe\View_home('Site/View', 'recipeCreate', 'Creer un cuisinier', 'La page de création de cuisinier');
            $view->AfficherVue(array(
                'message'   => $message,
                'cook'      => $cook,
                'nbCook'    => $nbCook));
        }
        ///////////////////////// SI TOUT EST OK ///////////////////////////
        if ((!empty($_POST['titre'])) && (!empty($_POST['cuisinier'])) && (!empty($_POST['difficulte'])) &&
            (!empty($_POST['duree'])) && (!empty($_POST['cout'])) && (!empty($_POST['ingredients'])) &&
            (!empty($_POST['description_recette'])) && (!empty($_POST['etapes'])) &&
            (!empty($_POST['personnes']))) {

            // Envoi des infos à La BDD
            $data = new sm\RecipeMother();
            $data->setTitre($_POST['titre']);$data->setVisible($_POST['visible']);$data->setCuisinier($_POST['cuisinier']);
            $data->setDifficulte($_POST['difficulte']);$data->setDuree($_POST['duree']);$data->setCout($_POST['cout']);
            $data->setIngredients($_POST['ingredients']);$data->setDescription_recette($_POST['description_recette']);
            $data->setEtapes($_POST['etapes']);$data->setPersonnes($_POST['personnes']);$data->setVisible($_POST['visible']);


            // Creation de la recette
            $manager = new sm\RecipeManager();
            $manager->CreateARecipe($data);
            $message = $manager->getMsgSuccesCreateARecipe();

            // Chargement des cuisiniers
            $manager = new sm\CookManager();
            $cook = $manager->ReadAllCook();
            $nbCook = $manager->NombreCuisinier();

            $view = new classe\View_home('Site/View', 'recipeCreate', 'Créer une recette', 'Création de recettes');
            $view->AfficherVue(array(
                'message'   => $message,
                'cook'      => $cook,
                'nbCook'    => $nbCook));
        }

    }

    /*************** UPDATE RECIPE ***************/
    public function UpdateARecipe()
    {
        ///////////////////////// SI TOUT EST OK ///////////////////////////
        if ((!empty($_POST['id_recette_update'])) && (!empty($_POST['titre_recette_update'])) &&
            (!empty($_POST['difficulte_recette_update'])) && (!empty($_POST['duree_recette_update'])) &&
            (!empty($_POST['cout_recette_update'])) && (!empty($_POST['ingredients_recette_update'])) &&
            (!empty($_POST['description_recette_update'])) && (!empty($_POST['etapes_recette_update'])) &&
            (!empty($_POST['personnes_recette_update'])) && (!empty($_POST['visible_recette_update']))) {
            // Envoi des infos à La BDD
            $datas = new sm\RecipeMother();
            $datas->setId_recette($_POST['id_recette_update']);$datas->setTitre($_POST['titre_recette_update']);
            $datas->setDifficulte($_POST['difficulte_recette_update']);$datas->setDuree($_POST['duree_recette_update']);
            $datas->setCout($_POST['cout_recette_update']);$datas->setIngredients($_POST['ingredients_recette_update']);
            $datas->setDescription_recette($_POST['description_recette_update']);$datas->setEtapes($_POST['etapes_recette_update']);
            $datas->setPersonnes($_POST['personnes_recette_update']);$datas->setVisible($_POST['visible_recette_update']);

            $manager = new sm\RecipeManager();
            $manager->UpdateARecipe($datas);
            $message = $manager->getMsgSuccesUpdateARecipe();

            // Envoi des information à la view
            $manager = new sm\RecipeManager();
            $recipes = $manager->ReadAllRecipe();
            $nombreRecettes = $manager->NombreRecette();

            // Creation de la view
            $view = new classe\View_home('Site/View', 'recipeUpdate', 'Mettre à jour une recette', 'Mise à jour de recettes');
            $view->AfficherVue(array(
                'recipes' => $recipes,
                'message' => $message,
                'nombreRecettes' => $nombreRecettes));
        } /////////////////////////SI DES CHAMPS SONT VIDES///////////////////////////
        else {
            // Envoi des information à la view
            $manager = new sm\RecipeManager();
            $recipes = $manager->ReadAllRecipe();
            $message = $manager->getMsgFailedUpdateARecipe();
            $nombreRecettes = $manager->NombreRecette();

            // Creation de la view
            $view = new classe\View_home('Site/View', 'recipeUpdate', 'Mettre à jour une recette', 'Mise à jour de recettes');
            $view->AfficherVue(array(
                'recipes' => $recipes,
                'message' => $message,
                'nombreRecettes' => $nombreRecettes));
        }
    }

    /*************** DELETE RECIPE ***************/
    public function DeleteARecipe()
    {
        ///////////////////////// SI TOUT EST OK ///////////////////////////
        if (!empty($_POST['id_recette_delete'])) {

            $data = new sm\RecipeMother;
            $data->setId_recette($_POST['id_recette_delete']);

            $manager = new sm\RecipeManager();
            $manager->DeleteARecipe($data);
            $message = $manager->getMsgSuccesDeleteARecipe();

            // Envoi des information à la view
            $manager = new sm\RecipeManager();
            $recipes = $manager->ReadAllRecipe();
            $nombreRecettes = $manager->NombreRecette();

            // Creation de la view
            $view = new classe\View_home('Site/View', 'recipedelete', 'Mettre à jour une recette', 'Mise à jour de recettes');
            $view->AfficherVue(array(
                'recipes' => $recipes,
                'message' => $message,
                'nombreRecettes' => $nombreRecettes));
        } /////////////////////////SI DES CHAMPS SONT VIDES///////////////////////////
        else {
            // Envoi des information à la view
            $manager = new sm\RecipeManager();
            $recipes = $manager->ReadAllRecipe();
            $message = $manager->getMsgWarnDeleteARecipe();
            $nombreRecettes = $manager->NombreRecette();

            // Creation de la view
            $view = new classe\View_home('Site/View', 'recipeDelete', 'Mettre à jour une recette', 'Mise à jour de recettes');
            $view->AfficherVue(array(
                'recipes' => $recipes,
                'message' => $message,
                'nombreRecettes' => $nombreRecettes));
        }
    }

    /*************** CREATE ADMIN ***************/
    public function CreateAdmin()
    {
        if ((empty($_POST['role_admin'])) && (empty($_POST['pseudo_admin'])) &&
            (empty($_POST['email_admin'])) && (empty($_POST['password_admin']))) {
            // Creation des données d'envoi
            $manager = new sm\AdminManager();
            $message = $manager->getMsgFailedCreateAdmin();
            // Creation de View
            $view = new classe\View_home('Site/View/Admin', 'adminCreate', 'Création d\'un administrateur', 'Création d\'un administrateur');
            $view->AfficherVue(array(
                'message' => $message,));

        } else if ((empty($_POST['role_admin'])) || (empty($_POST['pseudo_admin'])) ||
            (empty($_POST['email_admin'])) || (empty($_POST['password_admin']))) {
            // Creation des données d'envoi
            $manager = new sm\AdminManager();
            $message = $manager->getMsgFailedCreateAdmin();
            // Creation de View
            $view = new classe\View_home('Site/View/Admin', 'adminCreate', 'Création d\'un administrateur', 'Création d\'un administrateur');
            $view->AfficherVue(array(
                'message' => $message,));

        } else if ((isset($_POST['password_admin'])) !== (isset($_POST['conf_password_admin']))) {
            // Creation des données d'envoi
            $manager = new sm\AdminManager();
            $message = $manager->getMsgFailedPassword();
            // Creation de View
            $view = new classe\View_home('Site/View/Admin', 'adminCreate', 'Création d\'un administrateur', 'Création d\'un administrateur');
            $view->AfficherVue(array(
                'message' => $message));

        } else if ((!empty($_POST['role_admin'])) && (!empty($_POST['pseudo_admin'])) &&
            (!empty($_POST['email_admin'])) && (!empty($_POST['password_admin']))) {

            // Verification si le compte existe deja
            $pseudo = new sm\AdminManager();
            $verifPseudo = $pseudo->VerifPseudoMembre($_POST['pseudo_admin']);
            $verifEmail = $pseudo->VerifMailMembre($_POST['email_admin']);
            if ($verifPseudo == false) {
                // Creation des données d'envoi
                $manager = new sm\AdminManager();
                $message = $manager->getMsgFailedCreateAdminPseudo();
                // Creation de View
                $view = new classe\View_home('Site/View/Admin', 'adminCreate', 'Création d\'un administrateur', 'Création d\'un administrateur');
                $view->AfficherVue(array(
                    'message' => $message));
            } else if ($verifEmail == false) {
                // Creation des données d'envoi
                $manager = new sm\AdminManager();
                $message = $manager->getMsgFailedCreateAdminMail();
                // Creation de View
                $view = new classe\View_home('Site/View/Admin', 'adminCreate', 'Création d\'un administrateur', 'Création d\'un administrateur');
                $view->AfficherVue(array(
                    'message' => $message));
            } else if ((!is_numeric($_POST['password_admin'])) || (strlen($_POST['password_admin']) < 6)) {
                // Creation des données d'envoi
                $manager = new sm\AdminManager();
                $message = $manager->getMsgFailedPasswordNum();
                // Creation de View
                $view = new classe\View_home('Site/View/Admin', 'adminCreate', 'Création d\'un administrateur', 'Création d\'un administrateur');
                $view->AfficherVue(array(
                    'message' => $message));
            }

            //else if ((isset($_POST['role_admin'])) && (isset($_POST['pseudo_admin'])) &&
            //   (isset($_POST['email_admin'])) && (isset($_POST['password_admin'])) ){
            // Verification des données avant l'envoi
            else {
                $data = new sm\Admin();
                $data->setPseudo($_POST['pseudo_admin']);
                $data->setPassword($_POST['password_admin']);
                $data->setEmail($_POST['email_admin']);
                $data->setRole($_POST['role_admin']);

                // Creation des données d'envoi
                $manager = new sm\AdminManager();
                $manager->CreateAdmin($data);
                $message = $manager->getMsgSuccesCreateAdmin();


                // Creation de la vue
                $view = new classe\View_home('Site/View/Admin', 'adminCreate', 'Création d\'un administrateur', 'Création d\'un administrateur');
                $view->AfficherVue(array(
                    'message' => $message));

            }

        }


    }
}