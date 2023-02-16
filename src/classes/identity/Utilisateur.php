<?php

namespace Application\identity;

class Utilisateur{

    public int $id;
    public string $nom;
    public string $prenom;
    public string $email;
    public string $tel;


    public function __construct ($user){
        $this->id = $user->id_user;
        $this->nom = $user->nom;
        $this->prenom = $user->prenom;
        $this->email =  $user->email;
        $this->tel =  $user->tel;
    }



}