<div class="container mt-5">
    <h2 class='pt-3 text-center'><?php echo $action ?> un livre</h2>
    <form action="index.php?uc=livres&action=validerForm" method="post"
        class="col-md-8 offset-md-2 border border-primary p-5 rounded">

        <div class="row">
            <div class="col-3">
                <label for='isbn'> ISBN </label>

                <input type="text" class='form-control' id='isbn' name='isbn'
                    value="<?php if($action == "Modifier") {echo $leLivre->getIsbn() ;} ?>  ">
            </div>
            <div class="col">
                <label for='titre'> Titre </label>
                <input type="text" class='form-control' id='titre' placehoder='Saisir le titre du livre' name='titre'
                    value="<?php if($action == "Modifier") {echo $leLivre->getTitre() ;} ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-2">
                <label for='prix'> Prix </label>
                <input type="number" class='form-control' id='prix' name='prix'
                    value="<?php if($action == "Modifier") {echo $leLivre->getPrix() ;} ?>">
            </div>
            <div class="col-4">
                <label for='editeur'> Editeur </label>
                <input type="text" class='form-control' id='editeur' placehoder='Saisir l\' éditeur' du livre'
                    name='editeur' value="<?php if($action == "Modifier") {echo $leLivre->getEditeur() ;} ?>">
            </div>
            <div class="col-2">
                <label for='annee'> Année </label>
                <input type="number" class='form-control' id='annee' placehoder='Année de publication' name='annee'
                    value="<?php if($action == "Modifier") {echo $leLivre->getAnnee() ;} ?>">
            </div>
            <div class="col-4">
                <label for='langue'> Langue </label>
                <input type="text" class='form-control' id='langue' placehoder='langue du livre' name='langue'
                    value="<?php if($action == "Modifier") {echo $leLivre->getLangue() ;} ?>">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for='auteur'> Auteur </label>
                <select name="auteur" class="form-control">
                    <?php 
                    echo var_dump($lesAuteurs);
                        foreach($lesAuteurs as $auteur){
                            if($action == "Modifier"){
                            $selection=$auteur->numero == $leLivre->getAuteur()->getNum() ? 'selected' : '';
                            }
                            echo "<option value='".$auteur->numero."' ". $selection .">". $auteur->nom." ".$auteur->prenom ."</option>";
                        }
                        ?>
                </select>
            </div>
            <div class="col">
                <label for='genre'> Genre </label>
                <select name="genre" class="form-control">
                    <?php 
                        foreach($lesGenres as $genre){
                            if($action == "Modifier"){
                            $selection=$genre->getNum() == $leLivre->getGenre()->getNum() ? 'selected' : '';
                            }
                            echo "<option value='".$genre->getNum()."' ". $selection .">". $genre->getLibelle() ."</option>";
                        }
                        ?>
                </select>
            </div>
            <div class="col">
                <label for='type'> Type </label>
                <select name="type" class="form-control">
                    <?php 
                        foreach($lesTypes as $type){
                            if($action == "Modifier"){
                            $selection=$type->getNum() == $leLivre->getType()->getNum() ? 'selected' : '';
                            }
                            echo "<option value='".$type->getNum()."' ". $selection .">". $type->getLibelle() ."</option>";
                        }
                        ?>
                </select>
            </div>
        </div>

        <input type="hidden" id="num" name="num" value="<?php if($action == "Modifier") {echo $leLivre->getNum();} ?>">
        <div class="row mt-5">
            <div class="col"> <a href="index.php?uc=livres&action=list" class='btn btn-warning btn-block'>Revenir
                    à la liste</a> </div>
            <div class="col"><button type='submit' class='btn btn-success btn-block'> <?php echo $action ?> </button>
            </div>
        </div>
    </form>
</div>