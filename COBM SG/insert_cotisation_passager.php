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

    //get montant
    function get_montant($connect,$ID_activ)
    {
        $sql_activ="SELECT montant from activite where id_activite=$ID_activ";
        $result_activ = mysqli_query($connect, $sql_activ);
        $row_activ= mysqli_fetch_assoc($result_activ);
        return $row_activ['montant'];

    }
     get_montant($connect,3);

    // get date fin
    function get_date_fin($date,$mois)
    {
            $date = strtotime("+".$mois." months", strtotime($date));
            $date_fin= date('Y-m-d',$date);
            return $date_fin;
    }
    
            //activites
            $Tennis=$_GET["Tennis"];
            $Equitation=$_GET["Equitation"];
            $Salle=$_GET["Salle"];
            $Foot=$_GET["Foot"];
            //info
            $IDS=$_GET["IDS"];
            $Mois=$_GET["mois"];
            $Dates=$_GET["dates"];
            $Nom_lien=$_GET['Nom'];
            $Prenom_lien=$_GET['Prenom'];

            //tenis
            $count= count($Tennis);

            
             for($i=0;$i<$count;$i++)
             {
                 if($Tennis[$i]!='0')
                {
                    //get lien id
                    $sql_lien= "select ID_lien from lien ORDER BY ID_lien DESC LIMIT 1 ";
                    $result_lien = mysqli_query($connect, $sql_lien);
                    $row_lien= mysqli_fetch_assoc($result_lien);
                    $ID_lien=$row_lien['ID_lien']+1;
                    //
                    
                    $sql3="INSERT INTO `lien`(`ID_lien`, `nom`, `prenom`, `type`, `date_naissance`, `ID_adhesion`) 
                    VALUES ('$ID_lien','$Nom_lien[$i]','$Prenom_lien[$i]','passager','','0')";

                    $result3= mysqli_query($connect,$sql3);
                    if($result3)
                    echo 'lien inserted'.'<br>';
                    else
                    echo 'lien not inserted'.'<br>';
                    echo $ID_lien ;

                    //id_cotisation
                    $sql_id= "select ID_cotisation from cotisation ORDER BY ID_cotisation DESC LIMIT 1 ";
                    $result_id = mysqli_query($connect, $sql_id);
                    $row_id= mysqli_fetch_assoc($result_id);
                    $ID_cotisation=$row_id['ID_cotisation']+1;
                    //ID_adhesion
                    $ID_adhesion=$_GET["ID_adhesion2"];
                    //ID lien
                    
                    //ID activite
                    $ID_activite=$Tennis[$i];
                    //montant
                    $montant= get_montant($connect,$ID_activite);
                    //date_debut
                    $Dates[$i] = date("Y-m-d", strtotime(str_replace('/', '-', $Dates[$i])));
                    //date_fin
                    $date_finn = get_date_fin($Dates[$i],1);
                    //sql
                    $sql_insert="INSERT INTO `cotisation`(`ID_cotisation`, `ID_adhesion`, `ID_lien`, `ID_activite`, `montant`, `date_debut`, `date_fin`)
                    VALUES ('$ID_cotisation','0','$ID_lien','$ID_activite','$montant','$Dates[$i]','$date_finn')";
                    $res_insert=mysqli_query($connect,$sql_insert);
                    if($res_insert)
                    echo 'cotisation inserted'."<br>";
                    else
                    echo 'cotisation  not inserted'."<br>";
                    
                    echo $sql_insert;
                }
             }
             //equitation
             for($i=0;$i<$count;$i++)
             {
                 if($Equitation[$i]!='0')
                {
                     //create an lien
                   
                    //get lien id
                    $sql_lien= "select ID_lien from lien ORDER BY ID_lien DESC LIMIT 1 ";
                    $result_lien = mysqli_query($connect, $sql_lien);
                    $row_lien= mysqli_fetch_assoc($result_lien);
                    $ID_lien=$row_lien['ID_lien']+1;
                    //
                    
                    $sql3="INSERT INTO `lien`(`ID_lien`, `nom`, `prenom`, `type`, `date_naissance`, `ID_adhesion`) 
                    VALUES ('$ID_lien','$Nom_lien[$i]','$Prenom_lien[$i]','passager','','0')";

                    $result3= mysqli_query($connect,$sql3);
                    if($result3)
                    echo 'lien inserted'.'<br>';
                    else
                    echo 'lien not inserted'.'<br>';


                    //id_cotisation
                    $sql_id= "select ID_cotisation from cotisation ORDER BY ID_cotisation DESC LIMIT 1 ";
                    $result_id = mysqli_query($connect, $sql_id);
                    $row_id= mysqli_fetch_assoc($result_id);
                    $ID_cotisation=$row_id['ID_cotisation']+1;
                    //ID_adhesion
                    $ID_adhesion=$_GET["ID_adhesion2"];
                    
                    //ID activite
                    $ID_activite=$Equitation[$i];
                    //montant
                    $montant= get_montant($connect,$ID_activite);
                    //date_debut
                    $Dates[$i] = date("Y-m-d", strtotime(str_replace('/', '-', $Dates[$i])));
                    //date_fin
                    $date_finn = get_date_fin($Dates[$i],1);
                    //sql
                    $sql_insert="INSERT INTO `cotisation`(`ID_cotisation`, `ID_adhesion`, `ID_lien`, `ID_activite`, `montant`, `date_debut`, `date_fin`)
                    VALUES ('$ID_cotisation','0','$ID_lien','$ID_activite','$montant','$Dates[$i]','$date_finn')";
                    $res_insert=mysqli_query($connect,$sql_insert);
                    if($res_insert)
                    echo 'cotisation inserted'."<br>";
                    else
                    echo 'cotisation nott inserted'."<br>";
                    
                    echo $sql_insert;
                }
             }
             //sale
             for($i=0;$i<$count;$i++)
             {
                 if($Salle[$i]!='0')
                {
                   
                    //get lien id
                    $sql_lien= "select ID_lien from lien ORDER BY ID_lien DESC LIMIT 1 ";
                    $result_lien = mysqli_query($connect, $sql_lien);
                    $row_lien= mysqli_fetch_assoc($result_lien);
                    $ID_lien=$row_lien['ID_lien']+1;
                    //
                    
                    $sql3="INSERT INTO `lien`(`ID_lien`, `nom`, `prenom`, `type`, `date_naissance`, `ID_adhesion`) 
                    VALUES ('$ID_lien','$Nom_lien[$i]','$Prenom_lien[$i]','passager','','0')";

                    $result3= mysqli_query($connect,$sql3);
                    if($result3)
                    echo 'lien inserted'.'<br>';
                    else
                    echo 'lien not inserted'.'<br>';
                    echo $ID_lien ;

                    //id_cotisation
                    $sql_id= "select ID_cotisation from cotisation ORDER BY ID_cotisation DESC LIMIT 1 ";
                    $result_id = mysqli_query($connect, $sql_id);
                    $row_id= mysqli_fetch_assoc($result_id);
                    $ID_cotisation=$row_id['ID_cotisation']+1;
                    //ID_adhesion
                    $ID_adhesion=$_GET["ID_adhesion2"];
                    //ID lien
                    
                    //ID activite
                    $ID_activite=$Salle[$i];
                    //montant
                    $montant= get_montant($connect,$ID_activite);
                    //date_debut
                    $Dates[$i] = date("Y-m-d", strtotime(str_replace('/', '-', $Dates[$i])));
                    //date_fin
                    $date_finn = get_date_fin($Dates[$i],1);
                    //sql
                    $sql_insert="INSERT INTO `cotisation`(`ID_cotisation`, `ID_adhesion`, `ID_lien`, `ID_activite`, `montant`, `date_debut`, `date_fin`)
                    VALUES ('$ID_cotisation','0','$ID_lien','$ID_activite','$montant','$Dates[$i]','$date_finn')";
                    $res_insert=mysqli_query($connect,$sql_insert);
                    if($res_insert)
                    echo 'cotisation inserted'."<br>";
                    else
                    echo 'cotisation  not inserted'."<br>";
                    
                    echo $sql_insert;
                }
             }
             //foot
             for($i=0;$i<$count;$i++)
             {
                 if($Foot[$i]!='0')
                {
                    //create an lien
                   
                    //get lien id
                    $sql_lien= "select ID_lien from lien ORDER BY ID_lien DESC LIMIT 1 ";
                    $result_lien = mysqli_query($connect, $sql_lien);
                    $row_lien= mysqli_fetch_assoc($result_lien);
                    $ID_lien=$row_lien['ID_lien']+1;
                    //
                    
                    $sql3="INSERT INTO `lien`(`ID_lien`, `nom`, `prenom`, `type`, `date_naissance`, `ID_adhesion`) 
                    VALUES ('$ID_lien','$Nom_lien[$i]','$Prenom_lien[$i]','passager','','0')";

                    $result3= mysqli_query($connect,$sql3);
                    if($result3)
                    echo 'lien inserted'.'<br>';
                    else
                    echo 'lien not inserted'.'<br>';


                    //id_cotisation
                    $sql_id= "select ID_cotisation from cotisation ORDER BY ID_cotisation DESC LIMIT 1 ";
                    $result_id = mysqli_query($connect, $sql_id);
                    $row_id= mysqli_fetch_assoc($result_id);
                    $ID_cotisation=$row_id['ID_cotisation']+1;
                    //ID_adhesion
                    $ID_adhesion=$_GET["ID_adhesion2"];
                    
                    //ID activite
                    $ID_activite=$Foot[$i];
                    //montant
                    $montant= get_montant($connect,$ID_activite);
                    //date_debut
                    $Dates[$i] = date("Y-m-d", strtotime(str_replace('/', '-', $Dates[$i])));
                    //date_fin
                    $date_finn = get_date_fin($Dates[$i],1);
                    //sql
                    $sql_insert="INSERT INTO `cotisation`(`ID_cotisation`, `ID_adhesion`, `ID_lien`, `ID_activite`, `montant`, `date_debut`, `date_fin`)
                    VALUES ('$ID_cotisation','0','$ID_lien','$ID_activite','$montant','$Dates[$i]','$date_finn')";
                    $res_insert=mysqli_query($connect,$sql_insert);
                    if($res_insert)
                    echo 'cotisation inserted'."<br>";
                    else
                    echo 'cotisation  not inserted'."<br>";
                    
                    echo $sql_insert;
                }
             }
           
           
        

?>
</body>
</html>
<?php include("footer.php") ?>