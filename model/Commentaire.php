<?php 

class Commentaires {

    private $id;
    private $idbillet;
    private $pseudo;
    private $commentaire;
    private $date_message;
    private $signalement;

    public function __construct(Array $data){
        $this->hydrate($data);

    }

    public function hydrate($data){
        if(isset($data['id'])){
            $this->setId($data['id']);
        }
        if(isset($data['idbillet'])){
            $this->setIdBillet($data['idbillet']);
        }
        if(isset($data['pseudo'])){
            $this->setPseudo($data['pseudo']);
        }
        if(isset($data['commentaire'])){
            $this->setCommentaire($data['commentaire']);
        }
        if(isset($data['date_message'])){
            $this->setDateMessage($data['date_message']);
        }
        if(isset($data['signalement'])){
            $this->setSignalement($data['signalement']);
        }
      
    }

    public function getId(){
        return $this->id; 
    }
    public function getIdBillet(){
        return $this->idbillet;
    }
    public function getPseudo(){
        return $this->pseudo;
    }
    public function getCommentaire(){
        return $this->commentaire;
    }
    public function getDateMessage(){
        return $this->date_message;
    }
    public function getSignalement(){
        return $this->signalement;
    }



    public function setId($id){
        $this->id = $id;
    }
    public function setIdbillet($idbillet){
        $this->idbillet = $idbillet;
    }
    public function setPseudo($pseudo){
        $this->pseudo = $pseudo;
    }
    public function setCommentaire($commentaire){
        $this->commentaire = htmlspecialchars($commentaire);
    }
    public function setDateMessage($date_message){
        $this->date_message = $date_message;
    }
    public function setSignalement($signalement){
        $this->signalement = $signalement;
    }




}