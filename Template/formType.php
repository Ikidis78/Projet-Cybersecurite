<div class="container mt-5">
    <h2 class='pt-3 text-center'><?php echo $action ?> un type</h2>
    <form action="index.php?uc=types&action=validerForm" method="post"
        class="col-md-6 offset-md-3 border border-primary p-3 rounded">
        <div class="form-group">
            <label for='libelle'> Libellé </label>
            <input type="text" class='form-control' id='libelle' placehoder='Saisir le libellé' name='libelle'
                value="<?php if($action == "Modifier") {echo $leType->getLibelle() ;} ?>">
        </div>
        <input type="hidden" id="num" name="num" value="<?php if($action == "Modifier") {echo $leType->getNum();} ?>">
        <div class="row">
            <div class="col"> <a href="index.php?uc=types&action=list" class='btn btn-warning btn-block'>Revenir à
                    la liste</a> </div>
            <div class="col"><button type='submit' class='btn btn-success btn-block'> <?php echo $action ?> </button>
            </div>
        </div>
    </form>
</div>