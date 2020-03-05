
<?php 
 
        include("db_connect.php");
        //variables
        //resu id
            $sql_adh= "select recu_id from settings ORDER BY recu_id DESC LIMIT 1 ";
            $result_adh = mysqli_query($connect, $sql_adh);
            $row_adh= mysqli_fetch_array($result_adh);
            $ID_recu=$row_adh['recu_id']+1;

            $sql6="UPDATE `settings` SET `recu_id`=$ID_recu WHERE `recu_id`= $ID_recu-1" ;
             $reslt6 =mysqli_query($connect,$sql6);



        $today=date('d/m/Y');
        
        $ID_adhesion=$_GET['ID_adhesion'];

        $sql1="SELECT * FROM adhesion where  ID_adhesion =$ID_adhesion";
        $result1 = mysqli_query($connect, $sql1);
        $row1= mysqli_fetch_array($result1);
        $CIN=$row1['CIN'];
        $nom=$row1['nom'];
        $prenom=$row1['prenom'];
        $nbenfant=$row1['nbenfant'];
        $montant_avance=$row1['montant_avance'];
        $montant_recete=$row1['montant_recete'];
        $ID_pack=$row1['ID_pack'];
        $ID_abonnement=$row1['ID_abonnement'];

        $date_adhesion=$row1['date_adhesion'];
        $date_adhesion=date("d-m-Y", strtotime($date_adhesion));

        $date_fin=$row1['date_fin'];
        $date_fin=date("d-m-Y", strtotime($date_fin));

        $mode_paiment=$row1['mode_paiment'];
        //pack
        $sql2="SELECT * from packs where ID = $ID_pack";
        $result2 = mysqli_query($connect, $sql2);
        $row2= mysqli_fetch_array($result2);
        $pack=$row2['type_pack'];
        //abonn
        $sql3="SELECT * from abonnement where ID = $ID_abonnement";
        $result3 = mysqli_query($connect, $sql3);
        $row3= mysqli_fetch_array($result3);
        $abonn=$row3['type_Abonnement'];
        
        //Conjoint
        if($ID_pack!=1 && $ID_pack!=3)
        {
            $sql4="SELECT * from lien where ID_adhesion=$ID_adhesion && type!='enfant'";
            $result4= mysqli_query($connect, $sql4);
            $row4= mysqli_fetch_array($result4);
            $nom_conj=$row4['nom'];
            $prenom_conj=$row4['prenom'];
            $type_conj=$row4['type'];

        }
        
        
        

       
       
       

        


        $sql2="SELECT * from lien where ID_adhesion =$ID_adhesion";



        $file_name= $CIN+' : '+$nom;

        
?>
<body onload="Export2Doc('exportContent')" >
    <style>
        
        
    #exportContent{
        font-size:18px;
    }
    table {
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
}
    </style>
<div style="font-size:18px;line-height: 1.6;" id="exportContent">
<?php for($j=0;$j<2;$j++){ ?>
    <div>
</div>
<img  src="C://AppServ/www/AdminLTE-3.0.2/dist/img/logo_cobm2.png" alt=""> <b> CLUB OMNISPORTS BENI MELLAL</b>
    <h2></h2>
    <p style="" >
        <span>Reçu N°: <?php echo $ID_recu.'/20';  ?> </span> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
        &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<span>Date: le <?php echo $today ?></span>
        <br>
    </p>
    <div style="margin-left:50px;font-size:20px;" >
    
    <span><b>Reçu de:</b>  </span> <?php for($i=0;$i<20;$i++) echo '&nbsp' ?> <span  ><?php echo $prenom .' '.$nom ?></span>
    <br> 
    <span><b>CIN:</b>  </span> <?php for($i=0;$i<26;$i++) echo '&nbsp' ?> <span  > <?php echo $CIN ?> </span>
    <br> 
    <span><b>Avance:</b>  </span> <?php for($i=0;$i<21;$i++) echo '&nbsp' ?> <span  ><?php echo $montant_avance . ' DH'?></span>
    <br> 
    <span><b>Reste:</b>  </span> <?php for($i=0;$i<25;$i++) echo '&nbsp' ?><span  ><?php echo $montant_recete. ' DH'?></span>
    <br> 
    <span><b>Pack:</b>  </span><?php for($i=0;$i<25;$i++) echo '&nbsp' ?> <span  ><?php echo $pack?></span>
    <br> 
    <span><b>Abonnement:</b>  </span><?php for($i=0;$i<13;$i++) echo '&nbsp' ?><span><?php echo $abonn?></span>
    <br> 
    <span><b>Date validité:</b>  </span><?php for($i=0;$i<12;$i++) echo '&nbsp' ?><span> <?php echo 'DE '. $date_adhesion.' A '.$date_fin ?> </span>
    <br> <br>
    
    <?php 
if($ID_pack!=1 && $ID_pack!=3)
{
    echo '<table>
        <thead>
            <tr>
                <th>Prenom</th>
                <th>Lien</th>
                <th>Date Naissance</th>
            </tr>
        </thead>
        <tbody>';
}
        if($ID_pack!=1 && $ID_pack!=3)
        {
            echo '<tr>
            <td>'.$prenom_conj.'</td>
            <td>'.$type_conj.'</td>
            
            
            </tr>
            ';

        }
        for($i=0;$i<$nbenfant;$i++)
        {
            $sql5="SELECT * from lien where ID_adhesion=$ID_adhesion and type='enfant'";
            $result5= mysqli_query($connect, $sql5);
            $row5=mysqli_fetch_assoc($result5);
            $nom_enf=$row5['nom'];
            $prenom_enf=$row5['prenom'];
            $type_enf=$row5['type'];
            $date_naissance = $row5['date_naissance'];
            $date_naissance=date("d-m-Y", strtotime($date_naissance));
            

            echo '<tr>
            <td>'.$prenom_enf.'</td>
            <td> enfant </td>
            <td>'.$date_naissance.'</td>
            
            
            </tr>
            ';
        }
            
        

    
        
            
        




        echo'</tbody>
        </table>';
    
    
    
    ?>
       <?php for($i=0;$i<40;$i++) echo '&nbsp' ?> <b>SIGNATURE DIRECTION</b>
</div>
<?php } ?>
    
    
</div>
<div class="content-footer">
    <button id="btn-export" onclick="Export2Doc('exportContent');">Export to
        word doc</button>
</div>
</body>
<script>
    function Export2Doc(element, filename = ''){
    var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
    var postHtml = "</body></html>";
    var html = preHtml+document.getElementById(element).innerHTML+postHtml;

    var blob = new Blob(['\ufeff', html], {
        type: 'application/msword'
    });
    
    // Specify link url
    var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
    
    // Specify file name
    filename = filename?filename+'.doc':'document.doc';
    
    // Create download link element
    var downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob ){
        navigator.msSaveOrOpenBlob(blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = url;
        
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
        
        window.close();
    }
    
    document.body.removeChild(downloadLink);
}


</script>