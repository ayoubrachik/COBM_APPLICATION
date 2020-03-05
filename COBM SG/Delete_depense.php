<?php 
include("header.php");
include("db_connect.php");
 ?>

<?php 

    $ID_depense_del=$_GET["ID_depense_del"];
    echo $CIN;

    $sql="DELETE FROM depense WHERE ID_depense = '$ID_depense_del'";
    $result= mysqli_query($connect,$sql);
     if($result)
       echo 'depense deleted'.'<br>';         
     else           
        echo 'depense deleted'.'<br>';        


?>
<?php include("footer.php") ?>