<?php 
include("header.php");
include("db_connect.php");
 ?>

<?php 

    $ID_recette_del=$_GET["ID_recette_del"];
    echo $CIN;

    $sql="DELETE FROM recette WHERE ID_recette = '$ID_recette_del'";
    $result= mysqli_query($connect,$sql);
     if($result)
       echo 'recette deleted'.'<br>';         
     else           
        echo 'recette deleted'.'<br>';        


?>
<?php include("footer.php") ?>