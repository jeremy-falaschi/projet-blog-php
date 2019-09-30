<?php

class Utilisateur
{
    private $id;
    private $pseudo;
    private $email;
    private $mdp;
    private $membre;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate($data)
    {
        if (isset($data['id'])) {
            $this->setId($data['id']);
        }
        if (isset($data['pseudo'])) {
            $this->setPseudo($data['pseudo']);
        }
        if (isset($data['email'])) {
            $this->setEmail($data['email']);
        }
        if (isset($data['mdp'])) {
            $this->setMdp($data['mdp']);
        }
        if (isset($data['membre'])) {
            $this->setMembre($data['membre']);
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function getMembre()
    {
        return $this->membre;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    public function setMembre($membre)
    {
        $this->membre = $membre;
    }
}
