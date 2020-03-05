<?php 
include("header.php");
include("db_connect.php");
 ?>

<?php 

    $ID_cotisation_del=$_GET["ID_cotisation_del"];
    echo $CIN;

    $sql="DELETE FROM cotisation WHERE ID_cotisation = '$ID_cotisation_del'";
    $result= mysqli_query($connect,$sql);
     if($result)
       echo 'data2 deleted'.'<br>';         
     else           
        echo 'data2 deleted'.'<br>';        


?>
<?php include("footer.php") ?>