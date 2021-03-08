<?php
class Autoloader
{
    public static function autoload($class)
    {
        /////*** Autoloader ***/////
        spl_autoload_register(function ($class) {
            $chemin = str_replace('\\', '/', $class);
            require_once($chemin . '.php');
        });

        if (isset($_GET['page'])) {
            /////*** Déclaration des paramètres de la classe Rooter ***/////
            switch ($_GET['page']) {
                case 'Home':
                    $page = new \site\controller\Accueil;
                    $page->AfficherHome();
                    break;
                case 'login':
                    $page = new \site\controller\Accueil;
                    $page->AfficherLogin();
                    break;
                case 'Logout':
                    $page = new \site\controller\Accueil;
                    $page->seDeconnecter();
                    break;
                case 'cookCreate':
                    $page = new \site\controller\Accueil;
                    $page->CreateCook();
                    break;
                case 'recipeCreate':
                    $page = new \site\controller\Accueil;
                    $page->CreateRecipe();
                    break;
                case 'recipeUpdate':
                    $page = new \site\controller\Accueil;
                    $page->UpdateARecipe();
                    break;
                case 'recipeDelete':
                    $page = new \site\controller\Accueil;
                    $page->DeleteARecipe();
                    break;
                case 'adminCreate':
                    $page = new \site\controller\Accueil;
                    $page->CreateAdmin();
                    break;

            }
        } else if (isset($_GET['page']) == "") {
            $page = new \site\controller\Accueil();
            $page->AfficherLogin();
        }
    }
}


/* case 'login':
                     $namespace = 'site\controller\Accueil';
                     $methode   = 'AfficherLoginAdmin';
                     break;
                 case 'logout':
                     $namespace = 'controller\admin\Admin';
                     $methode   = 'seDeconnecter';
                     break;
                 case 'voir-article':
                     $namespace = 'controller\site\Accueil';
                     $methode   = 'AfficherArticle';
                     break;
                 case 'creer-article':
                     $namespace = 'controller\admin\Admin';
                     $methode   = 'CreerArticle';
                     break;
                 case 'modifier-article':
                     $namespace = 'controller\admin\Admin';
                     $methode   = 'ModifierArticle';
                     break;
                 case 'supprimer-article':
                     $namespace = 'controller\admin\Admin';
                     $methode   = 'SupprimerArticle';
                     break;
                 case 'admin-home':
                     $namespace = 'controller\admin\Admin';
                     $methode   = 'AfficherTousLesArticles';
                     break;
             }
            }

            $rooter = new classe\Rooter($namespace, $methode);
        } else {
            $rooter = new classe\Rooter('site\controller\Accueil', 'AfficherAccueil');
        }
        $rooter->ChooseController();
    }*/
