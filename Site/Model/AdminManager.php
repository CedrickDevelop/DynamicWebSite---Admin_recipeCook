<?php
namespace site\model;
use PDO;

class AdminManager {

//***************** RECHERCHE DES ADMIN **********************/
    public function ReadMembre($pseudo, $password) {
        $cnx = $this->Connexion();
        $sql = 'SELECT * FROM administrateur
				WHERE pseudo = :pseudo AND password = :password';
        $req = $cnx->prepare($sql);
        $req->execute(
            array('pseudo'  => $pseudo,
                'password'  => $password)
        );
        $data = $req->fetch(PDO::FETCH_ASSOC);

        $admin = new Admin();
        if (isset($data) !== false){
            $admin->setPseudo($data['pseudo']);
            $admin->setPassword($data['password']);
            $admin->setRole($data['role']);
            return $admin;
        }

    }

//***************** RECHERCHE DU MEMBRE ACTIF **********************/
    public function SearchMembre($pseudo, $password) {
        $pseudo = $_SESSION['pseudo'];
        $cnx = $this->Connexion();
        $sql = 'SELECT * FROM administrateur
				WHERE pseudo = :pseudo';
        $req = $cnx->prepare($sql);
        $req->execute($pseudo);
        $data = $req->fetch(PDO::FETCH_ASSOC);

        $admin = new Admin();
        if (isset($data) !== false){
            $admin->setPseudo($data['pseudo']);
            $admin->setRole($data['role']);
            return $admin;
        }

    }
//***************** MESSAGE PROBLEME DE CONNEXION ADMIN ******/
    public function getMsgVide() {
        $msg = '<p class="message_formulaire_failed">Veuillez entrer vos codes d\'accès</p>';
        return $msg;
    }
    public function getMsgErreur() {
        $msg = '<p class="message_formulaire_failed">Les codes entrés ne sont pas corrects !</p>';
        return $msg;
    }

//***************** CREATION ADMIN **********************/
    public function CreateAdmin(Admin $data) {
        $cnx = $this->Connexion();
        $sql = 'INSERT INTO administrateur (pseudo, email, password, role)
				VALUES (:pseudo, :email, :password, :role)';
        $req = $cnx->prepare($sql);
        $req->bindValue(':pseudo', $data->getPseudo(), PDO::PARAM_STR);
        $req->bindValue(':email', $data->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':password', $data->getPassword(), PDO::PARAM_INT);
        $req->bindValue(':role', $data->getRole(), PDO::PARAM_STR);
        $req->execute();

    }
//***************** MESSAGE PROBLEME DE CONNEXION ADMIN ******/
    public function getMsgFailedCreateAdmin() {
        $msg = '<p class="message_formulaire_failed">Veuillez remplir tous les champs</p>';
        return $msg;
    }
    public function getMsgFailedPassword() {
        $msg = '<p class="message_formulaire_failed">Le mot de passe et la confirmation doivent être similaires</p>';
        return $msg;
    }
    public function getMsgFailedPasswordNum() {
        $msg = '<p class="message_formulaire_failed">Votre mot de passe doit être de 6 numéros</p>';
        return $msg;
    }
    public function getMsgSuccesCreateAdmin() {
        $msg = '<p class="message_formulaire_failed">L\'Administrateur a bien été créé !</p>';
        return $msg;
    }

//***************** VERIFICATION CREATION ADMIN ******/
    public function VerifPseudoMembre($data) {
        $cnx = $this->Connexion();
        $sql = 'SELECT pseudo FROM administrateur
				WHERE pseudo = ?';
        $req = $cnx->prepare($sql);
        $req->execute(array($data));
        $verif = $req->fetch();
        if ($verif){
            return false;
        } else {
            return true;
        }

    }
    public function VerifMailMembre($data) {
        $cnx = $this->Connexion();
        $sql = 'SELECT email FROM administrateur
				WHERE email = ?';
        $req = $cnx->prepare($sql);
        $req->execute(array($data));
        $verif = $req->fetch();
        if ($verif){
            return false;
        } else {
            return true;
        }

    }
//***************** PSEUDO ADMIN EXISTE DEJA ******/
    public function getMsgFailedCreateAdminPseudo() {
        $msg = '<p class="message_formulaire_failed">Le pseudo existe déjà</p>';
        return $msg;
    }
    public function getMsgFailedCreateAdminMail() {
        $msg = '<p class="message_formulaire_failed">Cet email est déjà associé à un compte</p>';
        return $msg;
    }


//***************** CONNEXION BDD ****************************/
    private function Connexion() {
        $cnx = new PDO('mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8', ''.CNX_LOGIN.'', ''.CNX_PASS.'');
        return $cnx;
    }
}