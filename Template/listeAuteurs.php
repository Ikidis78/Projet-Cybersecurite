<div class="container mt-5">
    <div class="row pt-3">
        <div class="col-9">
            <h2>Liste des auteurs</h2>
        </div>
        <div class="col-3"><a href="index.php?uc=auteurs&action=add" class='btn btn-success'><i
                    class="fas fa-plus-circle"></i> Créer un auteur</a> </div>
    </div>

    <form id="formRecherche" action="index.php?uc=auteurs&action=list" method="post"
        class="border border-primary rounded p-3 mt-3 mb-3">
        <div class="row">
            <div class="col">
                <input type="text" class='form-control' id='nom' placehoder='Saisir le libellé' name='nom'
                    value="<?php echo $nom; ?>">
            </div>
            <div class="col">
                <input type="text" class='form-control' id='prenom' placehoder='Saisir le libellé' name='prenom'
                    value="<?php echo $prenom; ?>">
            </div>
            <div class="col">
                <select name="nationalite" class="form-control">
                    <?php 
                        echo "<option value='Toutes'>Toutes les nationalités</option>";
                        foreach($lesNationalites as $nationalite){
                            $selection=$nationalite->numero == $nationaliteSel ? 'selected' : '';
                            echo "<option value='".$nationalite->numero."'".$selection.">".$nationalite->libNation."</option>";
                        }
                        ?>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-success btn-block"> Rechercher</button>
            </div>
        </div>
    </form>


    <table class="table table-hover table-striped">
        <thead>
            <tr class="d-flex">
                <th scope="col" class="col-md-2">Numéro</th>
                <th scope="col" class="col-md-3">Nom</th>
                <th scope="col" class="col-md-3">Prénom</th>
                <th scope="col" class="col-md-2">Continent</th>
                <th scope="col" class="col-md-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
    foreach($lesAuteurs as $auteur){
        echo "<tr class='d-flex'>";
        echo "<td class='col-md-2'>".$auteur->numero."</td>";
        echo "<td class='col-md-3'>".$auteur->nom."</td>";
        echo "<td class='col-md-3'>".$auteur->prenom."</td>";
        echo "<td class='col-md-2'>".$auteur->libNation."</td>";
        echo "<td class='col-md-2'>
            <a href='index.php?uc=auteurs&action=update&num=". $auteur->numero ."' class='btn btn-primary'><i class='fas fa-pen'></i></a>
            <a href='#modalSuppression' data-toggle='modal' data-message='Voulez vous supprimer cet auteur ?' data-suppression='index.php?uc=auteurs&action=delete&num=".$auteur->numero."' class='btn btn-danger'><i class='far fa-trash-alt'></i></a>
        </td>";
        echo "</tr>";
    }
    ?>

        </tbody>
    </table>
</div>