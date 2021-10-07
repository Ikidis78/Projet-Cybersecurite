<?php 

class Nationalite {

    /**
     * numéro de la nationalité
     *
     * @var int
     */
    private $num;
    /**
     * libellé de la nationalité
     *
     * @var string
     */
    private $libelle;
    /**
     * Continent d'id du continent
     *
     * @var int
     */
    private $numContinent;

/**
     * Get numéro de la nationalité
     *
     * @return  int
     */ 
    public function getNum():int
    {
        return $this->num;
    }

    /**
     * Set numéro de la nationalite
     *
     * @param  int  $num  numéro de la nationalité
     *
     * @return  self
     */ 
    public function setNum(int $num) :self
    {
        $this->num = $num;

        return $this;
    }

    /**
     * renvoi le libellé
     *
     * @return string
     */
    public function getLibelle() :string
    {
        return $this->libelle;
    }

    /**
     * ecrit le libellé
     *
     * @param string $libelle 
     * @return self
     */
    public function setLibelle(string $libelle) :self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * retourne le continent de la nationalité
     *
     * @return Continent
     */
    public function getContinent():Continent
    {
        return Continent::findId($this->numContinent);
    }

    /**
     * Affecte un continent à la nationalité
     *
     * @param Continent $continent
     * @return self
     */
    public function setContinent(Continent $continent):self
    {
        $this->numContinent = $continent->getNum();

        return $this;
    }

    /**
     * retourne la liste des nationalités
     *
     * @return Nationalite[]
     */
    public static function findAll(?string $libelle=null, ?string $continent=null) : array
    {
        //Construction de la requête
        $texteReq="select n.num as numero, n.libelle as 'libNation', c.libelle as 'libContinent'  from nationalite n, continent c where n.numContinent=c.num";
        if( $libelle != "" && $libelle != null) { $texteReq.= " and n.libelle like '%" .$libelle."%'";}
        if( $continent != "Tous" && $continent != null) { $texteReq.= " and c.num =" .$continent;}
        $texteReq.= " order by n.libelle";
        $req=MonPdo::getInstance()->prepare($texteReq);
        $req->setFetchMode(PDO::FETCH_OBJ); // attention pas de fetch_class car les colonnes ne correspondent pas à un objet nationalité
        $req->execute();
        $lesResultats=$req->fetchAll();
        return $lesResultats;
    }

    /**
     * retourne la nationalité en donnant son id
     *
     * @param integer $id id du nationalité recherchée
     * @return Nationalite retourne l'objet nationalité
     */
    public static function findId(int $id) : Nationalite
    {
        $req=MonPdo::getInstance()->prepare("select * from nationalite where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Nationalite');
        $req->bindParam(':id',$id);
        $req->execute();
        $leResultat=$req->fetch();
        return $leResultat;
    }
    /**
     * Permet d'ajouter une nationalité dans la base de données
     *
     * @param Nationalite $nationalite objet nationalité à ajouter
     * @return int $nb
     */
    public static function add(Nationalite $nationalite) :int
    {
        $req=MonPdo::getInstance()->prepare("insert into nationalite(libelle,numContinent) values(:libelle, :num)");
        $numContinent=$nationalite->getContinent()->getNum();
        $libelle=$nationalite->getLibelle();        
        $req->bindParam(':libelle', $libelle);
        $req->bindParam(':num', $numContinent);
        $nb=$req->execute();
        return $nb;
    }

    /**
     * supprime la nationalité dont le num est passé en paramètre
     *
     * @param Nationalite $nationalite objet nationalité à supprimer
     * @return int $nb
     */
    public static function delete(Nationalite $nationalite) : int
    {
        $req=MonPdo::getInstance()->prepare("delete from nationalite where num = :num");
        $num=$nationalite->getNum();
        $req->bindParam(':num', $num);
        $nb=$req->execute();
        return $nb;    
    }

    /**
     * modifie la nationalité
     *
     * @param Nationalité $nationalite objet nationalité à modifier
     * @return int $nb
     */
    public static function update(Nationalite $nationalite) : int
    {
        $req=MonPdo::getInstance()->prepare("update nationalite set libelle = :libelle, numContinent= :numContinent where num = :num");
        $num=$nationalite->getNum();
        $libelle=$nationalite->getLibelle();
        $numContinent=$nationalite->getContinent()->getNum();
        $req->bindParam(':num', $num);
        $req->bindParam(':libelle', $libelle);
        $req->bindParam(':numContinent', $numContinent);
        $nb=$req->execute();
        return $nb;
    }
}