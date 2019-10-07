<?php
class ArticleManager
{
    private $db;

    public function __construct()
    {
        $this->db = DataBaseConnection::getInstance();
    }

    public function add(Article $article)
    {
        $req = $this->db->prepare('INSERT INTO article (contenu, titre, id_auteur, date_article) VALUES (?, ?, ?, NOW())');
        $req->execute([
            $article->getContenu(),
            $article->getTitre(),
            $article->getIdAuteur()
        ]);
    }

    public function get($id)
    {
        $req = $this->db->prepare('SELECT contenu, titre, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_article FROM article WHERE id = ?');
        $req->execute([
            $id
        ]);
        return new Article($req->fetch());
    }

    public function delete($id)
    {
        $req = $this->db->prepare('DELETE from article WHERE id = ?');
        $req->execute([
            $id
        ]);
        return true;
    }

    public function getList()
    {
        $articles = [];
        $req = $this->db->query('SELECT id, contenu, titre, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_article FROM article ORDER BY id DESC');
        while ($data = $req->fetch()) {
            $articles[] = new Article($data);
        }
        return $articles;
    }

    public function update($id, $contenu, $titre)
    {
        $req = $this->db->prepare('UPDATE article SET contenu = :nvcontenu, titre = :nvtitre WHERE id = :id');
        $req->execute(array(
            'nvcontenu' => $contenu,
            'nvtitre' => $titre,
            'id' => $id
        ));
    }
}
