<?php 
class Genre {
/**
     * numéro du genre
     *
     * @var int
     */
    private $num;

    /**
     * libelle du genre
     *
     * @var string
     */
    private $libelle;

    /**
     * Get numéro du genre
     *
     * @return  int
     */ 
    public function getNum():int
    {
        return $this->num;
    }

    /**
     * Set numéro du genre
     *
     * @param  int  $num  numéro du genre
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
     * retourne l'ensemble des genres
     *
     * @return Genre[]
     */
    public static function findAll() : array
    {
        $req=MonPdo::getInstance()->prepare("select * from genre order by libelle");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'genre');
        $req->execute();
        $lesResultats=$req->fetchAll();
        return $lesResultats;
    }

    /**
     * retourne le genre en donnant son id
     *
     * @param integer $id id du genre recherché
     * @return Genre retourne l'objet genre
     */
    public static function findId(int $id) : Genre
    {
        $req=MonPdo::getInstance()->prepare("select * from genre where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'genre');
        $req->bindParam(':id',$id);
        $req->execute();
        $leResultat=$req->fetch();
        return $leResultat;
    }
    /**
     * Permet d'ajouter un genre dans la base de données
     *
     * @param Genre $genre objet genre à ajouter
     * @return int $nb
     */
    public static function add(Genre $genre) :int
    {
        $req=MonPdo::getInstance()->prepare("insert into genre(libelle) values(:libelle)");
        $libelle=$genre->getLibelle();
        $req->bindParam(':libelle',$libelle);
        $nb=$req->execute();
        return $nb;
    }

    /**
     * supprime le genre dont le num est passé en paramètre
     *
     * @param Genre $genre objet continent à supprimer
     * @return int $nb
     */
    public static function delete(Genre $genre) : int
    {
        $req=MonPdo::getInstance()->prepare("delete from genre where num = :num");
        $num=$genre->getNum();
        $req->bindParam(':num', $num);
        $nb=$req->execute();
        return $nb;    
    }

    /**
     * modifie le genre
     *
     * @param Genre $genre objet genre à modifier
     * @return int $nb
     */
    public static function update(Genre $genre) : int
    {
        $req=MonPdo::getInstance()->prepare("update genre set libelle = :libelle where num = :num");
        $num=$genre->getNum();
        $libelle=$genre->getLibelle();
        $req->bindParam(':num', $num);
        $req->bindParam(':libelle',$libelle);
        $nb=$req->execute();
        return $nb;
    }

    /**
     * renvoie le nombre de genres de la base de données
     *
     * @return int
     */
    public static function nombreGenres() :int
    {
        $req=MonPdo::getInstance()->prepare("select count(*) as 'nb' from genre");
        $req->execute();
        $leResultat=$req->fetch();
        return $leResultat[0];
     }
}