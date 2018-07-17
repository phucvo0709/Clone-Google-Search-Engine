<?php
include("../config.php");
if(isset($_POST["src"])){
    $query = $con->prepare("UPDATE images SET broken = 1 WHERE imageUrl = :imageUrl ");
    $query->bindParam(":imageUrl", $_POST["src"]);
    $query->execute();
}else{
    echo "no image passed to page";
}