<?php 

class Auteur {

    /**
     * numéro de la auteur
     *
     * @var int
     */
    private $num;
    
    /**
     * libellé de la auteur
     *
     * @var string
     */
    private $nom;

    /**
     * prénom de l'auteur
     *
     * @var string
     */
    private $prenom;
    
    /**
     * Continent d'id de la nationalité
     *
     * @var int
     */
    private $numNationalite;

    /**
     * Get numéro de l'auteur
     *
     * @return  int
     */ 
    public function getNum():int
    {
        return $this->num;
    }

    /**
     * Set numéro de l'auteur
     *
     * @param  int  $num  numéro de l'auteur
     *
     * @return  self
     */ 
    public function setNum(int $num) :self
    {
        $this->num = $num;

        return $this;
    }

    /**
     * renvoi le nom
     *
     * @return string
     */
    public function getNom() :string
    {
        return $this->nom;
    }

    /**
     * ecrit le nom
     *
     * @param string $nom 
     * @return self
     */
    public function setNom(string $nom) :self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getPrenom() : string
    {
        return $this->prenom;
    }

    /**
     *
     * @param string $prenom
     * @return self
     */
    public function setPrenom($prenom) : self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * retourne la nationalité de la auteur
     *
     * @return Nationalite
     */
    public function getNationalite():Nationalite
    {
        return Nationalite::findId($this->numNationalite);
    }

    /**
     * Affecte  la nationalité de l'auteur
     *
     * @param Nationalite $nationalite
     * @return self
     */
    public function setNationalite(Nationalite $nationalite):self
    {
        $this->numNationalite = $nationalite->getNum();

        return $this;
    }

    /**
     * retourne la liste des auteurs
     *
     * @return Auteur[]
     */
    public static function findAll(?string $nom=null, ?string $prenom=null, ?string $nationalite=null) : array
    {
        //Construction de la requête
        $texteReq="select a.num as numero, a.nom as 'nom', a.prenom as 'prenom', n.libelle as 'libNation'  from auteur a, nationalite n where a.numNationalite=n.num";
        if( $nom != "" && $nom != null) { $texteReq.= " and a.nom like '%" .$nom."%'";}
        if( $prenom != "" && $prenom != null) { $texteReq.= " and a.prenom like '%" .$prenom."%'";}
        if( $nationalite != "Toutes" && $nationalite != null ) { $texteReq.= " and n.num =" .$nationalite;}
        $texteReq.= " order by a.nom";
        $req=MonPdo::getInstance()->prepare($texteReq);
        $req->setFetchMode(PDO::FETCH_OBJ); // attention pas de fetch_class car les colonnes ne correspondent pas à un objet auteur
        $req->execute();
        $lesResultats=$req->fetchAll();
        return $lesResultats;
    }

    /**
     * retourne l'auteur en donnant son id
     *
     * @param integer $id id du auteur recherchée
     * @return Auteur retourne l'objet auteur
     */
    public static function findId(int $id) : Auteur
    {
        $req=MonPdo::getInstance()->prepare("select * from auteur where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Auteur');
        $req->bindParam(':id',$id);
        $req->execute();
        $leResultat=$req->fetch();
        return $leResultat;
    }
    /**
     * Permet d'ajouter un auteur dans la base de données
     *
     * @param Auteur $auteur objet auteur à ajouter
     * @return int $nb
     */
    public static function add(Auteur $auteur) :int
    {
        $req=MonPdo::getInstance()->prepare("insert into auteur(nom,prenom,numNationalite) values(:nom, :prenom, :num)");
        $numNationalite=$auteur->getNationalite()->getNum();
        $nom=$auteur->getNom();        
        $prenom=$auteur->getPrenom();        
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':num', $numNationalite);
        $nb=$req->execute();
        return $nb;
    }

    /**
     * supprime l'auteur passé en paramètre
     *
     * @param Auteur $auteur objet auteur à supprimer
     * @return int $nb
     */
    public static function delete(Auteur $auteur) : int
    {
        $req=MonPdo::getInstance()->prepare("delete from auteur where num = :num");
        $num=$auteur->getNum();
        $req->bindParam(':num', $num);
        $nb=$req->execute();
        return $nb;    
    }

    /**
     * modifie l'auteur
     *
     * @param Auteur $auteur objet auteur à modifier
     * @return int $nb
     */
    public static function update(Auteur $auteur) : int
    {
        $req=MonPdo::getInstance()->prepare("update auteur set nom = :nom, prenom= :prenom, numNationalite= :numNationalite where num = :num");
        $num=$auteur->getNum();
        $nom=$auteur->getNom();
        $prenom=$auteur->getPrenom();
        $numNationalite=$auteur->getNationalite()->getNum();
        $req->bindParam(':num', $num);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':numNationalite', $numNationalite);
        $nb=$req->execute();
        return $nb;
    }

    /**
     * renvoie le nombre d'auteurs de la base de données
     *
     * @return int
     */
    public static function nombreAuteurs() : int
    {
        $req=MonPdo::getInstance()->prepare("select count(*) as 'nb' from auteur");
        $req->execute();
        $leResultat=$req->fetch();
        return $leResultat[0];
     }
   
}