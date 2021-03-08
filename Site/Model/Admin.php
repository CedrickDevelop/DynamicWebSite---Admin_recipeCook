<?php
namespace site\model;

class Admin {
    public $idAdministrateur;
    public $pseudo;
    public $email;
    public $password;
    public $role;


//*******************GETTER***************************
//****************************************************
    public function getIdAdministrateur() {
        return $this->idAdministrateur;
    }

    public function getPseudo() {
        return $this->pseudo;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

//*******************SETTER***************************
//****************************************************
    public function setIdAdministrateur($idAdministrateur) {
        if($idAministrateur > 0) {
            $this->idAdministrateur = $idAdministrateur;
        }
    }
    public function setPseudo($pseudo) {
        if(is_string($pseudo)) {
            $this->pseudo = $pseudo;
        }
    }
    public function setPassword($password) {
        if(is_string($password)) {
            $this->password = $password;
        }
    }
    public function setEmail($email) {
        if(is_string($email)) {
            $this->email = $email;
        }
    }
    public function setRole($role) {
        if(is_string($role)) {
            $this->role = $role;
        }
    }
}