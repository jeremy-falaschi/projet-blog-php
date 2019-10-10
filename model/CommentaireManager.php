<?php
class CommentairesManager
{
    private $db;

    public function __construct()
    {
        $this->db = DataBaseConnection::getInstance();
    }

    public function add(Commentaires $commentaires)
    {
        $req = $this->db->prepare('INSERT INTO commentaires (idbillet, pseudo, commentaire, date_message) VALUES (?, ?, ?, NOW())');
        $req->execute([
            $commentaires->getIdBillet(),
            $commentaires->getPseudo(),
            $commentaires->getCommentaire()
        ]);
    }

    public function get($id)
    {
        $req = $this->db->prepare('SELECT * FROM `commentaires` WHERE id = ?');
        $req->execute([
            $id
        ]);
        $data = $req->fetch();
        if($data){
            return new Commentaires($data);
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $req = $this->db->prepare('DELETE from commentaires WHERE id = ?');
        $req->execute([
            $id
        ]);
        return true;
    }

    public function signal($id)
    {
        $req = $this->db->prepare('UPDATE commentaires SET signalement = ? WHERE id = ?');
        $req->execute([
            1,
            $id
        ]);
        return true;
    }

    public function getList($idBillet)
    {
        $commentaires = [];
        $req = $this->db->prepare("SELECT id, pseudo, commentaire, idbillet, DATE_FORMAT(date_message, '%d/%m/%Y à %Hh%imin%ss') AS date_message FROM commentaires WHERE idbillet = ?");
        $req->execute([
            $idBillet
        ]);
        while ($data = $req->fetch()) {
            $commentaires[] = new Commentaires($data);
        }
        return $commentaires;
    }

    public function getListSignal()
    {
        $commentairesSignal = [];
        $req = $this->db->query('SELECT id, idbillet, pseudo, commentaire, DATE_FORMAT(date_message, \'%d/%m/%Y à %Hh%imin%ss\') AS date_message FROM commentaires WHERE signalement = 1 ORDER BY idbillet DESC');
        while ($data = $req->fetch()) {
            $commentairesSignal[] = new Commentaires($data);
        }
        return $commentairesSignal;
    }

    public function getListNoSignal()
    {
        $commentairesNoSignal = [];
        $req = $this->db->query('SELECT id, idbillet, pseudo, commentaire, DATE_FORMAT(date_message, \'%d/%m/%Y à %Hh%imin%ss\') AS date_message FROM commentaires WHERE signalement = 0 ORDER BY idbillet DESC');
        while ($data = $req->fetch()) {
            $commentairesNoSignal[] = new Commentaires($data);
        }
        return $commentairesNoSignal;
    }
}
