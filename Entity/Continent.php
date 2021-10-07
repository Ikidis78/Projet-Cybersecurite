<?php 
class Continent {
/**
     * numéro du continent
     *
     * @var int
     */
    private $num;

    /**
     * libelle du continent
     *
     * @var string
     */
    private $libelle;

    /**
     * Get numéro du continent
     *
     * @return  int
     */ 
    public function getNum():int
    {
        return $this->num;
    }

    /**
     * Set numéro du continent
     *
     * @param  int  $num  numéro du continent
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
     * retourne l'ensemble des continents
     *
     * @return Continent[]
     */
    public static function findAll() : array
    {
        $req=MonPdo::getInstance()->prepare("select * from continent order by libelle");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Continent');
        $req->execute();
        $lesResultats=$req->fetchAll();
        return $lesResultats;
    }

    /**
     * retourne le continent en donnant son id
     *
     * @param integer $id id du continent recherché
     * @return Continent retourne l'objet continent
     */
    public static function findId(int $id) : Continent
    {
        $req=MonPdo::getInstance()->prepare("select * from continent where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Continent');
        $req->bindParam(':id',$id);
        $req->execute();
        $leResultat=$req->fetch();
        return $leResultat;
    }
    /**
     * Permet d'ajouter un continent dans la base de données
     *
     * @param Continent $continent objet continent à ajouter
     * @return int $nb
     */
    public static function add(Continent $continent) :int
    {
        $req=MonPdo::getInstance()->prepare("insert into continent(libelle) values(:libelle)");
        $libelle=$continent->getLibelle();
        $req->bindParam(':libelle', $libelle);
        $nb=$req->execute();
        return $nb;
    }

    /**
     * supprime le continent dont le num est passé en paramètre
     *
     * @param Continent $continent objet continent à supprimer
     * @return int $nb
     */
    public static function delete(Continent $continent) : int
    {
        $req=MonPdo::getInstance()->prepare("delete from continent where num = :num");
        $num=$continent->getNum();
        $req->bindParam(':num', $num );
        $nb=$req->execute();
        return $nb;    
    }

    /**
     * modifie le continent
     *
     * @param Continent $continent objet continent à modifier
     * @return int $nb
     */
    public static function update(Continent $continent) : int
    {
        $req=MonPdo::getInstance()->prepare("update continent set libelle = :libelle where num = :num");
        $num=$continent->getNum();
        $libelle=$continent->getLibelle();
        $req->bindParam(':num', $num);
        $req->bindParam(':libelle', $libelle);
        $nb=$req->execute();
        return $nb;
    }
}