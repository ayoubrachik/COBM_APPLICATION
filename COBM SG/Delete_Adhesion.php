<?php 
include("header.php");
include("db_connect.php");
 ?>

<?php 

    $ID_adhesion_del=$_GET["ID_adhesion_del"];
    echo $CIN;

    $sql="DELETE FROM adhesion WHERE ID_adhesion = '$ID_adhesion_del'";
    $result= mysqli_query($connect,$sql);
     if($result)
       echo 'data2 deleted'.'<br>';         
     else           
        echo 'data2 deleted'.'<br>';
    
     /* $sql2="DELETE FROM recette where ID_adhesion = '$ID_adhesion_del' ";
      $result2= mysqli_query($connect,$sql2);
      if($result2)
       echo 'recette deleted'.'<br>';         
     else           
        echo 'recette deleted'.'<br>';*/


?>
<?php include("footer.php") ?>