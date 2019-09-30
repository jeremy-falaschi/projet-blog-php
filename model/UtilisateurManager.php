<?php
class UtilisateurManager
{
    private $db;

    public function __construct()
    {
        require_once(APP_ROOT . '/DataBaseConnection.php');
        require_once(APP_ROOT . '/model/Utilisateur.php');
        $this->db = DataBaseConnection::getInstance();
    }

    public function add(Utilisateur $utilisateur)
    {
        $req = $this->db->prepare('INSERT INTO utilisateur (pseudo, email, mdp) VALUES (?, ?, ?)');
        $req->execute([
            $utilisateur->getPseudo(),
            $utilisateur->getEmail(),
            $utilisateur->getMdp()
        ]);
    }

    public function get($email)
    {
        $req = $this->db->prepare('SELECT * FROM utilisateur WHERE email = ?');
        $req->execute([
            $email
        ]);
        return new Utilisateur($req->fetch());
    }
}
