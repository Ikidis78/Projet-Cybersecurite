<div class="container mt-5">
    <div class="row pt-3">
        <div class="col-9">
            <h2>Liste des types</h2>
        </div>
        <div class="col-3"><a href="index.php?uc=types&action=add" class='btn btn-success'><i
                    class="fas fa-plus-circle"></i> Créer un type</a> </div>
    </div>

    <table class="table table-hover table-striped">
        <thead>
            <tr class="d-flex">
                <th scope="col" class="col-md-2">Numéro</th>
                <th scope="col" class="col-md-8">Libellé</th>
                <th scope="col" class="col-md-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
    foreach($lesTypes as $type){
        echo "<tr class='d-flex'>";
        echo "<td class='col-md-2'>".$type->getNum()."</td>";
        echo "<td class='col-md-8'>".$type->getLibelle()."</td>";
        echo "<td class='col-md-2'>
            <a href='index.php?uc=types&action=update&num=".$type->getNum()."' class='btn btn-primary'><i class='fas fa-pen'></i></a>
            <a href='#modalSuppression' data-toggle='modal' data-message='Voulez vous supprimer ce type ?' data-suppression='index.php?uc=types&action=delete&num=".$type->getNum()."' class='btn btn-danger'><i class='far fa-trash-alt'></i></a>
        </td>";
        echo "</tr>";
    }
    ?>
        </tbody>
    </table>
</div>