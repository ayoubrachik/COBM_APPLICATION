
<?php 
        include("header.php");
        include("db_connect.php");
        //variables
?>
<style>
    *{
        font-size:13px;
    }
</style>

<?php
            //adhesion
            $CIN_origine=$_GET['CIN_origine'];
            echo 'origin' .$CIN_origine."<br>";
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
            $sql1="UPDATE adhesion SET CIN='$CIN',nom='$nom',prenom='$prenom',date_adhesion='$date_adhesion',date_fin='$date_fin',montant_avance='$avance',
            montant_recete='$recete',tele='$tele',email='$email',mode_paiment='$mode_p' WHERE CIN='$CIN_origine'";
            echo $sql1;
            $result= mysqli_query($connect,$sql1);
            if($result)
            echo 'data updated'.'<br>';
            else
            echo 'data not updated'.'<br>';

            if($_GET["pack"]!=3 && $_GET["pack"]!=1 && $is_conjoint=="on" && $result )
            {
                //get conjoint ID
                

                //insertion: conjoint
            
                $sql2="UPDATE lien SET nom='$nom_Conjoint',prenom='$prenom_Conjoint',type='$type_conjoint' WHERE CIN_chef='$CIN' && type!='enfant' ";
                $result2= mysqli_query($connect,$sql2);
                if($result2)
                echo 'data2 updated'.'<br>';
                else
                echo 'data2 updated'.'<br>';
            }
            
            echo "ay";
            //inserion enfants 
                    $sql_enf= "select ID_lien from lien where CIN_chef='$CIN' && type='enfant' ";
                    $result_enf = mysqli_query($connect, $sql_enf);
                    $j=0;
                    while($row_enf= mysqli_fetch_assoc($result_enf))
                    {
                        $id_enff=$row_enf['ID_lien'];
                        $date_enf[$j] = date("Y-m-d", strtotime($date_enf[$j]));
                        //get id for enfants
                        
                        $sql3="UPDATE `lien` SET nom='$nom',prenom='$prenom_enf[$j]',date_naissance='$date_enf[$j]' WHERE CIN_chef='$CIN' AND ID_lien='$id_enff' and type='enfant' ";
                        echo $sql3;
                        $result3= mysqli_query($connect,$sql3);
                        if($result3)
                        {
                            echo 'data3 updated'.'<br>';
                        }
                    
                        else
                         echo 'data3 not updated'.'<br>';
                        $j++;
                         
                        
                    }

            if($_GET["nbenfant"]!=0 && $result)
            {
               
                

                
            }
            


            //echo
            echo 'cin:  ' . $CIN. "<br>";
            echo 'Nom:  ' . $nom . "<br>";
            echo 'Prenom:  ' . $prenom . "<br>";
            echo 'Date_Adhesion:  ' . $date_adhesion . "<br>";
            echo 'pack:  ' . $id_pack . "<br>";
            echo 'abon   '  .$id_abonn. "<br>";
            echo 'montant avancer  '  .$avance. "<br>";
            echo 'montant recete  '  . "<br>";
            echo 'tele'  .$tele. "<br>";
            echo 'nbenfant'  .$nbenfant. "<br>";
            echo '$date_fin::    '  .$date_fin. "<br>";
            echo 'rechete: '.$recete."<br>";
            echo '$Mode_p :  '.$Mode_p ."<br>";
            //echo conjoint
            if($pack!=1 ||  $pack!=null || $pack!=3 )
            {
                echo '$type_conjoint'  .$type_conjoint. "<br>";
                echo '$nom_Conjoint'  .$nom_Conjoint. "<br>";
                echo '$prenom_Conjoint   '  .$prenom_Conjoint. "<br>";   
            }
            //echo enfant
            for($j = 0; $j <$nbenfant; $j++)
            {
                echo 'prenom_enf: '. $prenom_enf[$j] . '<br>';
                echo 'Nom enf:   ' . $nom . "<br>";
                echo 'Certificat : '. $Certificat[$j]. "<br>";
                $date_enf[$j] = date("Y-m-d", strtotime($date_enf[$j]));
                echo 'date_enf  '. $date_enf[$j] . '<br>';
            }
           
        
        
        //
        

?>
<?php include("footer.php") ?>