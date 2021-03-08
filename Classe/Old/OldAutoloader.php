<?php
class Autoloader {

        //public $namespace;
        //public $methode;

	public static function autoload($class) {
		/////*** Autoloader ***/////
		spl_autoload_register( function($class) {
			$chemin = str_replace('\\','/',$class);
			require_once($chemin.'.php');
		});
		
		if(isset($_GET['page'])) {
		/////*** Déclaration des paramètres de la classe Rooter ***/////	
			switch($_GET['page']) {
				case 'accueil':
                    $namespace = 'site\controller\Accueil';
					$method = 'AfficherAccueil';
                    break;
                case 'Login':
                    $namespace = '\site\controller\Accueil';
                    $method = 'AfficherLogin';
                    break;


			}


		/////*** Instanciation de la classe Rooter ***/////

                    $rooter = new classe\Rooter($namespace, $method);
                    $rooter->ChooseController();

		}
		else {
			$rooter = new classe\Rooter('site\controller\Accueil', 'AfficherLogin');
            $rooter->ChooseController();
		}

	}
}