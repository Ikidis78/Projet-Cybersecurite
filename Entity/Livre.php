<?php 

class Livre {

    /**
     * numéro du livre
     *
     * @var int
     */
    private $num;
    
    /**
     * ISBN du livre
     *
     * @var string
     */
    private $isbn;

    /**
     * titre du livre
     *
     * @var string
     */
    private $titre;
    
    /**
     * prix du livre
     *
     * @var int
     */
    private $prix;

    /**
     * editeur du livre
     *
     * @var string
     */
    private $editeur;

    /**
     * année de publication du livre
     *
     * @var int
     */
    private $annee;

    /**
     * Langue du livre
     *
     * @var string
     */
    private $langue;

    /**
     * auteur du livre
     *
     * @var int
     */
    private $numAuteur;

    /**
     * genre du livre
     *
     * @var int
     */
    private $numGenre;

       /**
     * type du livre
     *
     * @var int
     */
    private $numType;

    /**
     * Get numéro du livre
     *
     * @return  int
     */ 
    public function getNum() :int
    {
        return $this->num;
    }

    /**
     * Set numéro du livre
     *
     * @param  int  $num  numéro du livre
     *
     * @return  self
     */ 
    public function setNum(int $num) :self
    {
        $this->num = $num;

        return $this;
    }

    /**
     * Get iSBN du livre
     *
     * @return  string
     */ 
    public function getIsbn() :string
    {
        return $this->isbn;
    }

    /**
     * Set iSBN du livre
     *
     * @param  string  $ISBN  ISBN du livre
     *
     * @return  self
     */ 
    public function setIsbn(string $ISBN) :self
    {
        $this->isbn = $ISBN;

        return $this;
    }

    /**
     * Get titre du livre
     *
     * @return  string
     */ 
    public function getTitre():string
    {
        return $this->titre;
    }

    /**
     * Set titre du livre
     *
     * @param  string  $titre  titre du livre
     *
     * @return  self
     */ 
    public function setTitre(string $titre) :self
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get prix du livre
     *
     * @return  int
     */ 
    public function getPrix() :int
    {
        return $this->prix;
    }

    /**
     * Set prix du livre
     *
     * @param  int  $prix  prix du livre
     *
     * @return  self
     */ 
    public function setPrix(int $prix) :self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get editeur du livre
     *
     * @return  string
     */ 
    public function getEditeur():string
    {
        return $this->editeur;
    }

    /**
     * Set editeur du livre
     *
     * @param  string  $editeur  editeur du livre
     *
     * @return  self
     */ 
    public function setEditeur(string $editeur):self
    {
        $this->editeur = $editeur;

        return $this;
    }

    /**
     * Get année de publication du livre
     *
     * @return  int
     */ 
    public function getAnnee():int
    {
        return $this->annee;
    }

    /**
     * Set année de publication du livre
     *
     * @param  int  $annee  année de publication du livre
     *
     * @return  self
     */ 
    public function setAnnee(int $annee):self
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get langue du livre
     *
     * @return  string
     */ 
    public function getLangue():string
    {
        return $this->langue;
    }

    /**
     * Set langue du livre
     *
     * @param  string  $langue  Langue du livre
     *
     * @return  self
     */ 
    public function setLangue(string $langue):self
    {
        $this->langue = $langue;

        return $this;
    }

    /**
     * retourne l'auteur du livre
     *
     * @return Auteur
     */
    public function getAuteur():Auteur
    {
        return Auteur::findId($this->numAuteur);
    }

    /**
     * Affecte  l'auteur au livre
     *
     * @param Auteur $auteur
     * @return self
     */
    public function setAuteur(Auteur $auteur):self
    {
        $this->numAuteur = $auteur->getNum();

        return $this;
    }

    /**
     * retourne le genre du livre
     *
     * @return Genre
     */
    public function getGenre():Genre
    {
        return Genre::findId($this->numGenre);
    }

        /**
     * retourne le type du livre
     *
     * @return Type
     */
    public function getType():Type
    {
        return Type::findId($this->numType);
    }

    /**
     * Affecte  le genre au livre
     *
     * @param Genre $genre
     * @return self
     */

    public function setGenre(Genre $genre):self
    {
        $this->numGenre = $genre->getNum();

        return $this;
    }

        /**
     * Affecte  le type au livre
     *
     * @param Type $type
     * @return self
     */
    public function setType(Type $type):self
    {
        $this->numType = $type->getNum();

        return $this;
    }

    /**
     * retourne la liste des livres
     *
     * @return Livre[]
     */
    public static function findAll(?string $titre=null, ?string $auteur=null, ?string $genre=null, string $type=null) : array
    {
        //Construction de la requête
        $texteReq="select l.*, a.nom, a.prenom, g.libelle as 'libGenre', t.libelle as 'libType' from livre l, auteur a, genre g, type t where l.numAuteur=a.num and l.numGenre=g.num and l.numType=t.num";
        if( $titre != "" && $titre != null) { $texteReq.= " and l.titre like '%" .$titre."%'";}
        if( $genre != "Tous" && $genre != null) { $texteReq.= " and l.numGenre = ". $genre;}
        if( $auteur != "Tous" && $auteur != null ) { $texteReq.= " and l.numAuteur =" .$auteur;}
        if( $type != "Tous" && $type != null) { $texteReq.= " and l.numType = ". $type;}
        $texteReq.= " order by l.titre";
        $req=MonPdo::getInstance()->prepare($texteReq);
        $req->setFetchMode(PDO::FETCH_OBJ); // attention pas de fetch_class car les colonnes ne correspondent pas à un objet auteur
        $req->execute();
        $lesResultats=$req->fetchAll();
        return $lesResultats;
    }

    /**
     * retourne le livre en donnant son id
     *
     * @param integer $id id du livre recherché
     * @return Livre retourne l'objet livre
     */
    public static function findId(int $id) : Livre
    {
        $req=MonPdo::getInstance()->prepare("select * from livre where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Livre');
        $req->bindParam(':id',$id);
        $req->execute();
        $leResultat=$req->fetch();
        return $leResultat;
    }
    /**
     * Permet d'ajouter un livre dans la base de données
     *
     * @param Livre $livre objet livre à ajouter
     * @return int $nb
     */
    public static function add(Livre $livre) :int
    {
        $req=MonPdo::getInstance()->prepare("insert into livre(ISBN,titre,prix,editeur,annee,langue,numAuteur,numGenre,numType) 
        values(:isbn, :titre, :prix, :editeur, :annee, :langue, :numAuteur, :numGenre, :numType)");
        $numAuteur=$livre->getAuteur()->getNum();
        $numGenre=$livre->getGenre()->getNum();
        $numType=$livre->getType()->getNum();
        $isbn=$livre->getIsbn();        
        $titre=$livre->getTitre();        
        $prix=$livre->getPrix();        
        $editeur=$livre->getEditeur();        
        $annee=$livre->getAnnee();        
        $langue=$livre->getLangue();               
      
        $req->bindParam(':isbn', $isbn);
        $req->bindParam(':titre', $titre);
        $req->bindParam(':prix', $prix);
        $req->bindParam(':editeur', $editeur);
        $req->bindParam(':annee', $annee);
        $req->bindParam(':langue', $langue);
        $req->bindParam(':numAuteur', $numAuteur);
        $req->bindParam(':numGenre', $numGenre);
        $req->bindParam(':numType', $numType);
        $nb=$req->execute();
        return $nb;
    }

    /**
     * supprime le livre passé en paramètre
     *
     * @param Livre $livre objet livre à supprimer
     * @return int $nb
     */
    public static function delete(Livre $livre) : int
    {
        $req=MonPdo::getInstance()->prepare("delete from livre where num = :num");
        $num=$livre->getNum();
        $req->bindParam(':num', $num);
        $nb=$req->execute();
        return $nb;    
    }

    /**
     * modifie le livre
     *
     * @param Livre $livre objet auteur à modifier
     * @return int $nb
     */
    public static function update(Livre $livre) : int
    {
        $req=MonPdo::getInstance()->prepare("update livre set isbn = :isbn, titre= :titre, prix= :prix, editeur= :editeur, annee= :annee, langue= :langue,
        numAuteur= :numAuteur, numGenre= :numGenre, numType= :numType where num = :num");
        
        $num=$livre->getNum();
        $isbn=$livre->getIsbn();        
        $titre=$livre->getTitre();        
        $prix=$livre->getPrix();        
        $editeur=$livre->getEditeur();        
        $annee=$livre->getAnnee();        
        $langue=$livre->getLangue();
        $numAuteur=$livre->getAuteur()->getNum();
        $numGenre=$livre->getGenre()->getNum();
        $numType=$livre->getType()->getNum();

        $req->bindParam(':num', $num);
        $req->bindParam(':isbn', $isbn);
        $req->bindParam(':titre', $titre);
        $req->bindParam(':prix', $prix);
        $req->bindParam(':editeur', $editeur);
        $req->bindParam(':annee', $annee);
        $req->bindParam(':langue', $langue);
        $req->bindParam(':numAuteur', $numAuteur);
        $req->bindParam(':numGenre', $numGenre);
        $req->bindParam(':numType', $numType);
        $nb=$req->execute();
        return $nb;
    }

    /**
     * renvoie le nombre de livres par genre
     *
     * @return array
     */
    public static function livreParGenre():array
    {
        $req=MonPdo::getInstance()->prepare("select g.libelle as 'genre', count(*) as 'nb' from livre l, genre g where l.numGenre=g.num group by g.num");
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $lesResultats=$req->fetchAll();
        $dataPoints=[];
        foreach ($lesResultats as $leResultat) {
            $dataPoints[]=["label"=>"$leResultat->genre" ,"y"=> intval($leResultat->nb)];
        }
        return $dataPoints;
     }
     public static function livreParType():array
     {
         $req=MonPdo::getInstance()->prepare("select t.libelle as 'type', count(*) as 'nb' from livre l, type t where l.numType=t.num group by t.num");
         $req->setFetchMode(PDO::FETCH_OBJ);
         $req->execute();
         $lesResultats=$req->fetchAll();
         $dataPoints=[];
         foreach ($lesResultats as $leResultat) {
             $dataPoints[]=["label"=>"$leResultat->type" ,"y"=> intval($leResultat->nb)];
         }
         return $dataPoints;
      }

     /**
      * renvoie le nombre de livres de la base de données
      *
      * @return int
      */
        public static function nombreLivres():int
    {
        $req=MonPdo::getInstance()->prepare("select count(*) as 'nb' from livre");
        $req->execute();
        $leResultat=$req->fetch();
        return $leResultat[0];
     }
}