<?php 
class Type {
/**
     * numéro du type
     *
     * @var int
     */
    private $num;

    /**
     * libelle du type
     *
     * @var string
     */
    private $libelle;

    /**
     * Get numéro du type
     *
     * @return  int
     */ 
    public function getNum():int
    {
        return $this->num;
    }

    /**
     * Set numéro du type
     *
     * @param  int  $num  numéro du type
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
     * retourne l'ensemble des types
     *
     * @return Type[]
     */
    public static function findAll() : array
    {
        $req=MonPdo::getInstance()->prepare("select * from type order by libelle");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'type');
        $req->execute();
        $lesResultats=$req->fetchAll();
        return $lesResultats;
    }

    /**
     * retourne le type en donnant son id
     *
     * @param integer $id id du type recherché
     * @return Type retourne l'objet type
     */
    public static function findId(int $id) : Type
    {
        $req=MonPdo::getInstance()->prepare("select * from type where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'type');
        $req->bindParam(':id',$id);
        $req->execute();
        $leResultat=$req->fetch();
        return $leResultat;
    }
    /**
     * Permet d'ajouter un type dans la base de données
     *
     * @param Type $type objet type à ajouter
     * @return int $nb
     */
    public static function add(Type $type) :int
    {
        $req=MonPdo::getInstance()->prepare("insert into type(libelle) values(:libelle)");
        $libelle=$type->getLibelle();
        $req->bindParam(':libelle',$libelle);
        $nb=$req->execute();
        return $nb;
    }

    /**
     * supprime le type dont le num est passé en paramètre
     *
     * @param Type $type objet continent à supprimer
     * @return int $nb
     */
    public static function delete(Type $type) : int
    {
        $req=MonPdo::getInstance()->prepare("delete from type where num = :num");
        $num=$type->getNum();
        $req->bindParam(':num', $num);
        $nb=$req->execute();
        return $nb;    
    }

    /**
     * modifie le type
     *
     * @param Type $type objet type à modifier
     * @return int $nb
     */
    public static function update(Type $type) : int
    {
        $req=MonPdo::getInstance()->prepare("update type set libelle = :libelle where num = :num");
        $num=$type->getNum();
        $libelle=$type->getLibelle();
        $req->bindParam(':num', $num);
        $req->bindParam(':libelle',$libelle);
        $nb=$req->execute();
        return $nb;
    }

    /**
     * renvoie le nombre de types de la base de données
     *
     * @return int
     */
    public static function nombreTypes() :int
    {
        $req=MonPdo::getInstance()->prepare("select count(*) as 'nb' from type");
        $req->execute();
        $leResultat=$req->fetch();
        return $leResultat[0];
     }
}