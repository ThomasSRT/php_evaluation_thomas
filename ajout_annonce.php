<?php
require 'base.php';
include_once 'head.php';

$errors=[];

if($_SERVER['REQUEST_METHOD']=='POST'){
    
    $nom=$_POST['nom']??'';
    $description=$_POST['description']??'';
    $code_postal=$_POST['code_postal']??'';
    $ville=$_POST['ville']??'';
    $type=$_POST['type']??'';
    $prix=$_POST['prix']??'';

    if(empty($nom)){
        $errors['nom']='le nom du bien est obligatoire';
    }elseif (strlen($nom) > 255) {
        $errors['nom'] = 'Le nom doit contenir au maximum 255 caractères.';
    }
    else {
        $nom=htmlspecialchars($nom);
    }

    if(empty($description)){
        $errors['description']='la description est obligatoire';
    }

    if(empty($code_postal)){
        $errors['code_postal']='le code postal est obligatoire';
    }

    if(empty($ville)){
        $errors['ville']='la ville est obligatoire';
    }

    if(empty($type)){
        $errors['type']='le type est obligatoire';
    }elseif($type !="vente"){
        $errors['type']="type inconnu";
    }

    if(empty($prix)){
        $errors['prix']='le prix est obligatoire';
    }

if(empty($errors)){
    $sql="INSERT INTO appartement(title, description, postale_code, city, type, price) VALUES(:nom,:description,:code_postal,:ville,:type,:prix)";
    $stmt=$connexion->prepare($sql);

    $stmt->bindParam(':nom',$nom,PDO::PARAM_STR);
    $stmt->bindParam(':description',$description,PDO::PARAM_STR);
    $stmt->bindParam(':code_postal',$code_postal,PDO::PARAM_STR);
    $stmt->bindParam(':ville',$ville,PDO::PARAM_STR);
    $stmt->bindParam(':type',$type,PDO::PARAM_STR);
    $stmt->bindParam(':prix',$prix,PDO::PARAM_STR);
    
    $stmt->execute();
}
}


?>

<main class="container-fluid my-4">
    <div class="row">
        <div class="col-md-8 m-auto">
            <h1 class="display-4 fw-normal">Ajouter une annonce</h1>
            <form action="" method="post" class="mt-4" enctype='multipart/form-data'>
                
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="text" class="form-control" name="nom" placeholder="nom" >
                    </div>
                </div>
                <small>
                    <?php echo $errors['nom']??'';?>
                </small>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="text" class="form-control" name="description" placeholder="description" >
                    </div>
                </div>
                <small>
                    <?php echo $errors['description']??'';?>
                </small>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="text" class="form-control" name="code_postal" placeholder="code postale" >
                    </div>
                </div>
                <small>
                    <?php echo $errors['code_postal']??'';?>
                </small>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="text" class="form-control" name="ville" placeholder="ville" >
                    </div>
                </div>
                <small>
                    <?php echo $errors['ville']??'';?>
                </small>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="text" class="form-control" name="type" placeholder="type" >
                    </div>
                </div>
                <small>
                    <?php echo $errors['type']??'';?>
                </small>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="number" class="form-control" name="prix" placeholder="prix" >
                    </div>
                </div>
                <small>
                    <?php echo $errors['prix']??'';?>
                </small>

                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Ajouter le produit</button>
            </form>
        </div>
    </div>
</main>