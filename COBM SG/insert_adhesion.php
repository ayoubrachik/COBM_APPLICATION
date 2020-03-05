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
<body onload="new_adhesion(isadd)" >
    <?php 
        include("header.php");
        include("db_connect.php");
        //variables
        
?>

<?php
            //get adhesion ID
            $sql_adh= "select ID_adhesion from adhesion ORDER BY ID_adhesion DESC LIMIT 1 ";
            $result_adh = mysqli_query($connect, $sql_adh);
            $row_adh= mysqli_fetch_array($result_adh);
            $ID_adh=$row_adh['ID_adhesion']+1;
            
            //adhesion
            $id_pack=$_GET["pack"];
            $id_abonn=$_GET["Abonn"];
            $CIN=$_GET["CNIE"];
            $nom=$_GET["Nom"];
            $prenom=$_GET["Prenom"];
            $date_adhesion=$_GET["Date_Adhesion"];
            $date_adhesion = date("Y-m-d", strtotime(str_replace('/', '-', $date_adhesion))); 
            //calcule date
            $date1 = str_replace('/', '-', $date_adhesion);
            $newDate = date("Y-m-d", strtotime($date1));  
            if($id_abonn==1)
            $newDate = strtotime("+12 months", strtotime($newDate));
            if($id_abonn==2)
            $newDate = strtotime("+6 months", strtotime($newDate));
            if($id_abonn==3)
            $newDate = strtotime("+3 months", strtotime($newDate));
            $date_fin= date('Y-m-d',$newDate);
            //fin calcule date
            $montant=$_GET["Montant"];
            $avance=$_GET["Avance"];
            $recete=$montant-$avance;
            $tele=$_GET["Tele"];
            $email=$_GET["Email"];
            $nbenfant=$_GET["nbenfant"];
            if($_GET["pack"]==1)
            $nbenfant=0;
            $mode_p=$_GET["Mode_p"];            
            //Conjoint
            $is_conjoint=$_GET["check"];
            $type_conjoint= $_GET["Type_Conjoint"];
            $nom_Conjoint = $_GET["Nom_Conjoint"];
            $prenom_Conjoint= $_GET["Prenom_Conjoint"]; 
            //enfant
            $prenom_enf=$_GET["prenom_enf"];
            $date_enf=$_GET["date_enf"];
            $date_enf = str_replace('/', '-', $date_enf);
            $Certificat=$_GET["Certificat"];
            //insertion: adhesion
            $sql1="INSERT INTO `adhesion`(`CIN`, `ID_adhesion`, `nom`, `prenom`, `date_adhesion`, `date_fin`, `ID_pack`, `ID_abonnement`, `montant_avance`, `montant_recete`, `tele`, `email`, `nbenfant`, `mode_paiment`)
            VALUES ('$CIN','$ID_adh','$nom','$prenom','$date_adhesion','$date_fin','$id_pack','$id_abonn','$avance','$recete','$tele','$email','$nbenfant','$mode_p')";
            $result= mysqli_query($connect,$sql1);
            if($result)
            echo ''.'<br>';
            else
            echo ''.'<br>';
           
            

            //insert recette
            $sql_ID= "select ID_recette from recette ORDER BY ID_recette DESC LIMIT 1 ";
            $result_ID = mysqli_query($connect, $sql_ID);
            $row_ID= mysqli_fetch_assoc($result_ID);
            $ID=$row_ID['ID_recette']+1;

        
            $description="CIN : ".$CIN." NOM ET PRENOM : ".$nom." ".$prenom;
            $sql_recette="INSERT INTO `recette`(`ID_recette`, `ID_type`, `Mode_p`, `num_cheque`, `date_recette`, `montant`, `Description`)
            VALUES ('$ID','6','$mode_p','','$date_adhesion','$montant','$description')";
            $result_recette=mysqli_query($connect,$sql_recette);
            if($result_recette)
            echo '';
            else
            echo '';











            if($_GET["pack"]!=3 && $_GET["pack"]!=1 && $is_conjoint=="on" && $result )
            {
                //get conjoint ID
                $sql_conj= "select ID_lien from lien ORDER BY ID_lien DESC LIMIT 1 ";
                $result_conj = mysqli_query($connect, $sql_conj);
                $row_conj= mysqli_fetch_assoc($result_conj);
                $ID_conj=$row_conj['ID_lien']+1;

                //insertion: conjoint

                

            
                $sql2="INSERT INTO `lien`(`ID_lien`, `nom`, `prenom`, `type`, `date_naissance`, `ID_adhesion`) 
                VALUES ('$ID_conj','$nom_Conjoint','$prenom_Conjoint','$type_conjoint','','$ID_adh')";
                $result2= mysqli_query($connect,$sql2);
                if($result2)
                echo ''.'<br>';
                else
                echo ''.'<br>';
            }
            
            
            //inserion enfants
            if($_GET["nbenfant"]!=0 && $result)
            {
               
                

                for($j = 0; $j <$nbenfant; $j++)
                {   
                    $date_enf[$j] = date("Y-m-d", strtotime($date_enf[$j]));
                    //get id for enfants
                    $sql_enf= "select ID_lien from lien ORDER BY ID_lien DESC LIMIT 1 ";
                    $result_enf = mysqli_query($connect, $sql_enf);
                    $row_enf= mysqli_fetch_assoc($result_enf);
                    $ID_enf=$row_enf['ID_lien']+1;
                    
                    


                    $sql3="INSERT INTO `lien`(`ID_lien`, `nom`, `prenom`, `type`, `date_naissance`, `ID_adhesion`) 
                    VALUES ('$ID_enf','$nom','$prenom_enf[$j]','enfant','$date_enf[$j]','$ID_adh')";

                    $result3= mysqli_query($connect,$sql3);
                    if($result3)
                    echo ''.'<br>';
                    else
                    echo ''.'<br>';
                    
                    
                }
            }
            


            //echo
           
        
        //
        

?>
    <input style="display:none;" value="<?php if($result && $result_recette ) echo 'true';else echo 'false'?>" id="isadd" type="text">
</body>
</html>
<script>
        
        var isadd= document.getElementById("isadd").value;
        
    </script>
<?php include("footer.php") ?>