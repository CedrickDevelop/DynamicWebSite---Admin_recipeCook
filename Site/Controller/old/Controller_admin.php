<?php

namespace Admin\Controller;

use classe;
use model\admin as ma;

class Controller_admin {

    public function AfficherLoginAdmin(){
        if( (empty($_POST['pseudo'])) || (empty($_POST['password'])) ) {
            $manager = new ma\AdminManager();
            $message = $manager->getMsgVide();
            $view = new classe\View_home_admin('Admin/View', 'Login_admin','Se connecter');
            $view->AfficherVue($message);
        } else {
            $manager = new ma\AdminManager();
            $membre = $manager->ReadMembre($_POST['pseudo'], $_POST['password']);
            if (($membre->getPseudo() == $_POST['pseudo']) and ($membre->getPassword() == $_POST['password'])) {
                $_SESSION['pseudo'] = $_POST['pseudo'];
                $this->AfficherCompte();
            } else {
                $manager = new ma\AdminManager();
                $message = $manager->getMsgErreur();
                $view = new classe\View_home_admin('Admin/View', 'Login_admin', 'Se connecter');
                $view->AfficherVue($message);
            }
        }

        //$manager = new ma\Admin_Manager();
        //$membre = $manager->ReadMembre($_POST['pseudo'], $_POST['password']);

        //$view = new Classe\View_home_admin('Admin/View', 'Login_admin','Se connecter');
        //$view->AfficherVue();
    }

        public function AfficherCompte(){
            $view = new Classe\View_home_admin('Admin/View', 'Home_admin','Gestion des recettes et cuisiniers');
            $view->AfficherVue();

        }

}