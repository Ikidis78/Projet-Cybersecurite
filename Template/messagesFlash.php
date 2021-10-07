<?php
if(!empty($_SESSION['message'])){
    $mesMessages=$_SESSION['message'];
    foreach($mesMessages as $key=>$message){
        echo '<div class="row pt-3">
            <div class="container mt-5" >
                <div class="alert alert-'.$key.' alert-dismissible fade show" role="alert">'.$message.'    
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            </div>';
    }
    $_SESSION['message']=[];
}