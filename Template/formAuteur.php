<div class="container mt-5">
    <h2 class='pt-3 text-center'><?php echo $action ?> un auteur</h2>
    <form action="index.php?uc=auteurs&action=validerForm" method="post"
        class="col-md-6 offset-md-3 border border-primary p-3 rounded">
        <div class="row">
            <div class="col">
                <label for='libelle'> Nom </label>
                <input type="text" class='form-control' id='nom' placehoder='Saisir le libellé' name='nom'
                    value="<?php if($action == "Modifier") {echo $leAuteur->getNom() ;} ?>">
            </div>
            <div class="col">
                <label for='prenom'> Prénom </label>
                <input type="text" class='form-control' id='prenom' placehoder='Saisir le libellé' name='prenom'
                    value="<?php if($action == "Modifier") {echo $leAuteur->getPrenom() ;} ?>">
            </div>
        </div>
        <div class="form-group">
            <label for='nationalite'> Nationalité </label>
            <select name="nationalite" class="form-control">
                <?php 
                echo var_dump($lesNationalites);
                    foreach($lesNationalites as $nationalite){
                        if($action == "Modifier"){
                        $selection=$nationalite->numero == $leAuteur->getNationalite()->getNum() ? 'selected' : '';
                        }
                        echo "<option value='".$nationalite->numero."' ". $selection .">". $nationalite->libNation ."</option>";
                    }
                    ?>
            </select>
        </div>
        <input type="hidden" id="num" name="num" value="<?php if($action == "Modifier") {echo $leAuteur->getNum();} ?>">
        <div class="row">
            <div class="col"> <a href="index.php?uc=auteurs&action=list" class='btn btn-warning btn-block'>Revenir
                    à la liste</a> </div>
            <div class="col"><button type='submit' class='btn btn-success btn-block'> <?php echo $action ?> </button>
            </div>
        </div>
    </form>
</div>