<?php
include "connect.php";


if(isset($_SESSION)){
    
    
    $id = $_SESSION['utilisateur']['id'];

    $requete = $bdd->prepare("DELETE FROM session WHERE clt_id=?");


    $requete->execute(
        array($id)
    );

    session_destroy();

    header("location:index.php");
}


?>