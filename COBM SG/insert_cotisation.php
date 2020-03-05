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

    setTimeout(function(){  window.location.href = "cotisation.php"; }, 500);
</script>
<body onload="" >
    <?php 
        include("header.php");
        include("db_connect.php");
        //variables
?>
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


            //tenis
            $count= count($Tennis);

            
             for($i=0;$i<$count;$i++)
             {
                 if($Tennis[$i]!='0')
                {
                    //id_cotisation
                    $sql_id= "select ID_cotisation from cotisation ORDER BY ID_cotisation DESC LIMIT 1 ";
                    $result_id = mysqli_query($connect, $sql_id);
                    $row_id= mysqli_fetch_assoc($result_id);
                    $ID_cotisation=$row_id['ID_cotisation']+1;
                    //ID_adhesion
                    $ID_adhesion=$_GET["ID_adhesion2"];
                    //ID lien
                    $ID_lien=$IDS[$i];
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
                    VALUES ('$ID_cotisation','$ID_adhesion','$ID_lien','$ID_activite','$montant','$Dates[$i]','$date_finn')";
                    $res_insert=mysqli_query($connect,$sql_insert);
                   /* if($res_insert)
                    echo 'data inserted'."<br>";
                    else
                    echo 'data  not inserteddd'."<br>";*/
                    
                   // echo $sql_insert;

                    //insert recette
                    $sql_ID= "select ID_recette from recette ORDER BY ID_recette DESC LIMIT 1 ";
                    $result_ID = mysqli_query($connect, $sql_ID);
                    $row_ID= mysqli_fetch_assoc($result_ID);
                    $ID=$row_ID['ID_recette']+1;
                    
                    $sqlactiv="SELECT intitule,type from activite where id_activite=$ID_activite";
                    $resactiv=mysqli_query($connect,$sqlactiv);
                    $rowactiv=mysqli_fetch_array($resactiv);
                    $acttt=$rowactiv['type']." : ". $rowactiv['intitule'];
                    
                   
                    if($ID_lien==0)
                    {
                        $sql7="SELECT * from adhesion where ID_adhesion=$ID_adhesion";
                        $res7=mysqli_query($connect,$sql7);
                        $row7=mysqli_fetch_assoc($res7);
                        $nom=$row7['nom'];
                        $prenom=$row7['prenom'];
                    }
                    else
                    {
                        $sql7="SELECT * from lien where ID_lien=$ID_lien";
                        $res7=mysqli_query($connect,$sql7);
                        $row7=mysqli_fetch_assoc($res7);
                        $nom=$row7['nom'];
                        $prenom=$row7['prenom'];
                    }

                    $description="ACTIVITE : ".$acttt." NOM ET PRENOM : ".$nom." ".$prenom;
                    $sql_recette="INSERT INTO `recette`(`ID_recette`, `ID_type`, `Mode_p`, `num_cheque`, `date_recette`, `montant`, `Description`)
                    VALUES ('$ID','7','','','$Dates[$i]','$montant','$description')";
                    $result_recette=mysqli_query($connect,$sql_recette);
                    if($result_recette)
                    echo 'recette inserted';
                    else
                    echo 'recette not inserted';
                   // echo $sql_recette;




                }
             }
             //equitation
             for($i=0;$i<$count;$i++)
             {
                 if($Equitation[$i]!='0')
                {
                    //id_cotisation
                    $sql_id= "select ID_cotisation from cotisation ORDER BY ID_cotisation DESC LIMIT 1 ";
                    $result_id = mysqli_query($connect, $sql_id);
                    $row_id= mysqli_fetch_assoc($result_id);
                    $ID_cotisation=$row_id['ID_cotisation']+1;
                    //ID_adhesion
                    $ID_adhesion=$_GET["ID_adhesion2"];
                    //ID lien
                    $ID_lien=$IDS[$i];
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
                    VALUES ('$ID_cotisation','$ID_adhesion','$ID_lien','$ID_activite','$montant','$Dates[$i]','$date_finn')";
                    $res_insert=mysqli_query($connect,$sql_insert);
                    if($res_insert)
                    echo 'data inserted';
                    else
                    echo 'data  not inserted';
                    
                   // echo $sql_insert;
                    //insert recette
                    $sql_ID= "select ID_recette from recette ORDER BY ID_recette DESC LIMIT 1 ";
                    $result_ID = mysqli_query($connect, $sql_ID);
                    $row_ID= mysqli_fetch_assoc($result_ID);
                    $ID=$row_ID['ID_recette']+1;
                    
                    $sqlactiv="SELECT intitule,type from activite where id_activite=$ID_activite";
                    $resactiv=mysqli_query($connect,$sqlactiv);
                    $rowactiv=mysqli_fetch_array($resactiv);
                    $acttt=$rowactiv['type']." : ". $rowactiv['intitule'];
                    //echo 'sdf'.$acttt;
                   
                    if($ID_lien==0)
                    {
                        $sql7="SELECT * from adhesion where ID_adhesion=$ID_adhesion";
                        $res7=mysqli_query($connect,$sql7);
                        $row7=mysqli_fetch_assoc($res7);
                        $nom=$row7['nom'];
                        $prenom=$row7['prenom'];
                    }
                    else
                    {
                        $sql7="SELECT * from lien where ID_lien=$ID_lien";
                        $res7=mysqli_query($connect,$sql7);
                        $row7=mysqli_fetch_assoc($res7);
                        $nom=$row7['nom'];
                        $prenom=$row7['prenom'];
                    }

                    $description="ACTIVITE : ".$acttt." NOM ET PRENOM : ".$nom." ".$prenom;
                    $sql_recette="INSERT INTO `recette`(`ID_recette`, `ID_type`, `Mode_p`, `num_cheque`, `date_recette`, `montant`, `Description`)
                    VALUES ('$ID','7','','','$Dates[$i]','$montant','$description')";
                    $result_recette=mysqli_query($connect,$sql_recette);
                    if($result_recette)
                    echo 'recette inserted';
                    else
                    echo 'recette not inserted';
                    //echo $sql_recette;
                }
             }
             //sale
             for($i=0;$i<$count;$i++)
             {
                 if($Salle[$i]!='0')
                {
                    //id_cotisation
                    $sql_id= "select ID_cotisation from cotisation ORDER BY ID_cotisation DESC LIMIT 1 ";
                    $result_id = mysqli_query($connect, $sql_id);
                    $row_id= mysqli_fetch_assoc($result_id);
                    $ID_cotisation=$row_id['ID_cotisation']+1;
                    //ID_adhesion
                    $ID_adhesion=$_GET["ID_adhesion2"];
                    //ID lien
                    $ID_lien=$IDS[$i];
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
                    VALUES ('$ID_cotisation','$ID_adhesion','$ID_lien','$ID_activite','$montant','$Dates[$i]','$date_finn')";
                    $res_insert=mysqli_query($connect,$sql_insert);
                    if($res_insert)
                    echo 'data inserted';
                    else
                    echo 'data  not inserted';
                    
                 //   echo $sql_insert;
                    //insert recette
                    $sql_ID= "select ID_recette from recette ORDER BY ID_recette DESC LIMIT 1 ";
                    $result_ID = mysqli_query($connect, $sql_ID);
                    $row_ID= mysqli_fetch_assoc($result_ID);
                    $ID=$row_ID['ID_recette']+1;
                    
                    $sqlactiv="SELECT intitule,type from activite where id_activite=$ID_activite";
                    $resactiv=mysqli_query($connect,$sqlactiv);
                    $rowactiv=mysqli_fetch_array($resactiv);
                    $acttt=$rowactiv['type']." : ". $rowactiv['intitule'];
                   // echo 'sdf'.$acttt;
                   
                    if($ID_lien==0)
                    {
                        $sql7="SELECT * from adhesion where ID_adhesion=$ID_adhesion";
                        $res7=mysqli_query($connect,$sql7);
                        $row7=mysqli_fetch_assoc($res7);
                        $nom=$row7['nom'];
                        $prenom=$row7['prenom'];
                    }
                    else
                    {
                        $sql7="SELECT * from lien where ID_lien=$ID_lien";
                        $res7=mysqli_query($connect,$sql7);
                        $row7=mysqli_fetch_assoc($res7);
                        $nom=$row7['nom'];
                        $prenom=$row7['prenom'];
                    }

                    $description="ACTIVITE : ".$acttt." NOM ET PRENOM : ".$nom." ".$prenom;
                    $sql_recette="INSERT INTO `recette`(`ID_recette`, `ID_type`, `Mode_p`, `num_cheque`, `date_recette`, `montant`, `Description`)
                    VALUES ('$ID','7','','','$Dates[$i]','$montant','$description')";
                    $result_recette=mysqli_query($connect,$sql_recette);
                    if($result_recette)
                    echo 'recette inserted';
                    else
                    echo 'recette not inserted';
                 //   echo $sql_recette;
                }
             }
             //foot
             for($i=0;$i<$count;$i++)
             {
                 if($Foot[$i]!='0')
                {
                   //id_cotisation
                   $sql_id= "select ID_cotisation from cotisation ORDER BY ID_cotisation DESC LIMIT 1 ";
                   $result_id = mysqli_query($connect, $sql_id);
                   $row_id= mysqli_fetch_assoc($result_id);
                   $ID_cotisation=$row_id['ID_cotisation']+1;
                   //ID_adhesion
                   $ID_adhesion=$_GET["ID_adhesion2"];
                   //ID lien
                   $ID_lien=$IDS[$i];
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
                   VALUES ('$ID_cotisation','$ID_adhesion','$ID_lien','$ID_activite','$montant','$Dates[$i]','$date_finn')";
                   $res_insert=mysqli_query($connect,$sql_insert);
                   if($res_insert)
                   echo 'data inserted';
                   else
                   echo 'data  not inserted';
                   
                   //echo $sql_insert;
                   //insert recette
                   $sql_ID= "select ID_recette from recette ORDER BY ID_recette DESC LIMIT 1 ";
                   $result_ID = mysqli_query($connect, $sql_ID);
                   $row_ID= mysqli_fetch_assoc($result_ID);
                   $ID=$row_ID['ID_recette']+1;
                   
                   $sqlactiv="SELECT intitule,type from activite where id_activite=$ID_activite";
                    $resactiv=mysqli_query($connect,$sqlactiv);
                    $rowactiv=mysqli_fetch_array($resactiv);
                    $acttt=$rowactiv['type']." : ". $rowactiv['intitule'];
                   echo '======actiivvv'.$acttt."====";

                 //  echo '====='.$sqlactiv."====";
                  
                   if($ID_lien==0)
                   {
                       $sql7="SELECT * from adhesion where ID_adhesion=$ID_adhesion";
                       $res7=mysqli_query($connect,$sql7);
                       $row7=mysqli_fetch_assoc($res7);
                       $nom=$row7['nom'];
                       $prenom=$row7['prenom'];
                   }
                   else
                   {
                       $sql7="SELECT * from lien where ID_lien=$ID_lien";
                       $res7=mysqli_query($connect,$sql7);
                       $row7=mysqli_fetch_assoc($res7);
                       $nom=$row7['nom'];
                       $prenom=$row7['prenom'];
                   }

                   $description="ACTIVITE : ".$acttt." NOM ET PRENOM : ".$nom." ".$prenom;
                   $sql_recette="INSERT INTO `recette`(`ID_recette`, `ID_type`, `Mode_p`, `num_cheque`, `date_recette`, `montant`, `Description`)
                   VALUES ('$ID','7','','','$Dates[$i]','$montant','$description')";
                   $result_recette=mysqli_query($connect,$sql_recette);
                   if($result_recette)
                   echo 'recette inserted';
                   else
                   echo 'recette not inserted';
                  // echo $sql_recette;
                }
             }
           
           
        

?>
</body>
</html>
<?php include("footer.php") ?>