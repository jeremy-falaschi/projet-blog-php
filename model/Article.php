<?php

class Article
{
    private $id;
    private $contenu;
    private $titre;
    private $id_auteur;
    private $date_article;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate($data)
    {
        if (isset($data['id'])) {
            $this->setId($data['id']);
        }
        if (isset($data['contenu'])) {
            $this->setContenu($data['contenu']);
        }
        if (isset($data['titre'])) {
            $this->setTitre($data['titre']);
        }
        if (isset($data['id_auteur'])) {
            $this->setIdAuteur($data['id_auteur']);
        }
        if (isset($data['date_article'])) {
            $this->setDateArticle($data['date_article']);
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getIdAuteur()
    {
        return $this->id_auteur;
    }

    public function getDateArticle()
    {
        return $this->date_article;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function setIdAuteur($id_auteur)
    {
        $this->id_auteur = $id_auteur;
    }

    public function setDateArticle($date_article)
    {
        $this->date_article = $date_article;
    }
}
