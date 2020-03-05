<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<script>
    setTimeout(function(){  window.location.href = "Depenses.php"; }, 500);
</script>
<body onload="" >
    <?php 
        include("header.php");
        include("db_connect.php");
        //variables
?>
<style>
    *{
        font-size:12px !important;
    }
</style>
<?php

        //variables
        $ID_type_depense=$_GET['ID_depense'];
        //
        $mode_p=$_GET['mode_p'];
        //
        $num_cheque=$_GET['num_cheque'];
        //montant
        $montant=$_GET['montant'];
        //date
        $date=$_GET['date'];
        $date= date("Y-m-d", strtotime(str_replace('/', '-', $date))); 
        //description
        $description=$_GET['description'];

       /* echo '===='. $ID_type_depense."<br>";
        echo $mode_p."<br>";
        echo $num_cheque."<br>";
        echo $montant."<br>";
        echo $date."<br>";
        echo $description."<br>";*/

        //get recette ID:
        $sql_ID= "select ID_depense from depense ORDER BY ID_depense DESC LIMIT 1 ";
        $result_ID = mysqli_query($connect, $sql_ID);
        $row_ID= mysqli_fetch_assoc($result_ID);
        $ID=$row_ID['ID_depense']+1;

       // echo $ID;
        $sql="INSERT INTO `depense`(`ID_depense`, `ID_type`, `Mode_p`, `num_cheque`, `date_depense`, `montant`, `Description`)
         VALUES ('$ID','$ID_type_depense','$mode_p','$num_cheque','$date','$montant','$description')";
         $result1=mysqli_query($connect,$sql);

         echo $sql;
         if($result1)
         echo 'depense inserted';
         else
         echo 'depense not inserted';


?>
</body>
</html>
<?php include("footer.php") ?>