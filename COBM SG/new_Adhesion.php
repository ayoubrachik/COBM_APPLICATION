<html>
    <head>
  

    </head>
<body>
    <?php

    
include("header.php");
include("db_connect.php");
$query= "select * from packs";
$query2= "select * from abonnement";
$result= mysqli_query($connect,$query);
$result2= mysqli_query($connect,$query2);
$pack=$_GET["pack"];
$nbenfant=$_GET["nbenfant"];
$Abonn=$_GET["Abonn"];

if(!isset($nbenfant))
    $nbenfant = 0;

    if($pack == 1)
        $nbenfant = 0;


?>
  <style>
    .col-md-4 span,.col-md-6 span
    {
    color: red;
    
    }
    *{
        
        font-size:10px !important;
    }
    
    </style>

<div  onload="tarif()" class="container">
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Informations Adhesions</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- start select -->
            <div class="col-md-4">
                <div style="text-align: center;" class="form-group">
                    <label  >Type Adhésion<span>(*)</span></label>
                    <form action="insert_adhesion.php" method="GET" onsubmit="return valide()"  >
                        <select id="pack" name="pack" class="form-control"   onchange="window.location.href='new_Adhesion.php?Abonn=<?PHP echo $Abonn; ?>&pack='+this.value+'&nbenfant=<?php echo $nbenfant ?>'">
                            <option value="0" disabled selected >selectionner Type Adhésion</option>
                            <?php while($row= mysqli_fetch_array($result)):;?>
                            <option <?php if($row[0]==$pack) echo 'selected' ?> value="<?php echo $row[0];?>"> <?php echo $row[1];?>  </option>
                            <?php endwhile;?>
                        </select>
                    
                    <?php
                            
                            $pack=$_GET["pack"];
                            echo "select pack is => ".$pack;
                        
                    ?>
                </div>
            </div>
            <!-- end select -->   
            <!-- start select -->
            <div  class="col-md-4 new_Adhesion">
                <div style="text-align: center;" class="form-group">
                    <label>Type Abonnement<span>(*)</span></label>
                    <select id="Abonn" name="Abonn" class="form-control"  onchange="window.location.href='new_Adhesion.php?Abonn='+this.value+'&pack=<?php echo $pack ?>&nbenfant=<?php echo $nbenfant ?>'">
                            <option value="0" disabled selected >selectionner Type Abonnement</option>
                            <?php while($row2= mysqli_fetch_array($result2)):;?>
                            <option <?php if($row2[0]==$Abonn) echo 'selected' ?> value="<?php echo $row2[0];?>"> <?php echo $row2[1];?> </option>
                            <?php endwhile;?>
                        </select>
                </div>
            </div>
            <!-- end select -->   
            
            <!-- start select -->
            <div class="col-md-4">
                <div style="text-align: center;" class="form-group">
                    <label>Nombre enfants <span>(*)</span></label>
                        
                        <select id="nbenfant" name="nbenfant" <?php if($pack==1 || $pack==null ) echo 'disabled' ?> id="enfantscombo" class="form-control" onchange="window.location.href='new_Adhesion.php?Abonn=<?php echo $Abonn ?>&pack=<?php echo $pack?>&nbenfant='+this.value" >
                        <?PHP
                            for($j = 0; $j <9; $j++)
                            {
                        ?>
                        <option <?php if($nbenfant==$j) echo 'selected' ?> value="<?php echo $j ?>"><?php if($pack==1) echo 0; else echo $j ?></option>
                        <?PHP
                            }
                        ?>
                        </select>
                    
                </div>
            </div>
            <!-- end select -->    
        </div>
    </div>
            
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Informations Adhesions</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- start select -->
            <div class="col-md-4">
                <div style="text-align: center;" class="form-group">
                    <label>CNIE<span>(*)</span></label>
                    <input onkeyup="tarif();Toupper(this.id)" value="<?php ?>"  name="CNIE" type="text" class="form-control" id="CIN" placeholder="CNIE">
                </div>
            </div>
            <!-- end select -->   
            <!-- start select -->
            <div  class="col-md-4 new_Adhesion">
                <div style="text-align: center;" class="form-group">
                    <label>Nom<span>(*)</span></label>
                    <input onkeyup="Toupper(this.id)" name="Nom" type="text" class="form-control" id="nom" placeholder="Nom">
                </div>
            </div>
            <!-- end select -->   
            <!-- start select -->
            <div class="col-md-4">
                <div style="text-align: center;" class="form-group">
                    <label>Prenom<span>(*)</span></label>
                    <input onkeyup="Toupper(this.id)" name="Prenom" type="text" class="form-control" id="prenom" placeholder="Prenom">
                </div>
            </div>
            <!-- end select --> 
            <!-- start select -->
            <div class="col-md-4">
                <div style="text-align: center;" class="form-group">
                    <label>Date Adhésion<span>(*)</span></label>
                    <input name="Date_Adhesion"  type="text" class="form-control" id="Date_Adhesion" placeholder="jj/mm/aaaa">
                </div>
            </div>
            <!-- end select -->  
            <!-- start select -->
            <div class="col-md-4">
                <div style="text-align: center;" class="form-group">
                    <label>Tele<span>(*)</span></label>
                    <input name="Tele" type="text" class="form-control" id="Tele" placeholder="Tele">
                </div>
            </div>
            <!-- end select -->  
            <!-- start select -->
            <div class="col-md-4">
                <div style="text-align: center;" class="form-group">
                    <label>Email</label>
                    <input name="Email" type="text" class="form-control" id="Email" placeholder="Email">
                </div>
            </div>
            <!-- end select -->     
        </div>
    </div>
            
</div>

    <div onload="check()"  <?php if($pack==1 || $pack==3 || $pack==null) echo "style='display:none'"; else echo "style='display:'";  ?> class="card">
        <div class="card-header">
            <h3 class="card-title">Informations Conjoint(e) et autre</h3>
            <div style="float:right">
                 
                 <input name="check" <?php  if($pack!=1 && $pack!=3 ) echo 'checked' ?>  onclick="check()" id="check2" type="checkbox" >
            </div>
        </div>
       
        <div id="Conjoit1" class="card-body">
            <div class="row">
            <div  class="col-md-2">
                <div style="text-align: center;" class="form-group">
                    <label>Type<span></span></label>
                        <select onchange="change_sexe()" id="Conjoint" name="Type_Conjoint" class="form-control ">
                            <option value="époux" >époux</option>
                            <option value="épouse" >épouse</option>
                            <option value="pére" >pére</option>
                            <option value="mére" >mére</option>
                            <option value="frére" >frére</option>
                            <option value="sœur" >sœur</option>
                        </select>
                </div>
            </div>
                <!-- start select -->
                <div class="col-md-5">
                    <div style="text-align: center;" class="form-group">
                        <label id="nom_epou2" >Nom époux <span>(*)</span></label>
                        <input onkeyup="Toupper(this.id)" type="text" name="Nom_Conjoint" class="form-control" id="nom_epou" placeholder="">
                    </div>
                </div>
                <!-- end select -->   
                <!-- start select -->
                <div class="col-md-5">
                    <div style="text-align: center;" class="form-group">
                        <label id="prenom_epou" >Prenom époux <span>(*)</span></label>
                        <input onkeyup="Toupper(this.id)" name="Prenom_Conjoint"  type="text" class="form-control" id="Prenom_epou" placeholder="">
                    </div>
                </div>
                <!-- end select -->   
            </div>
        </div>
    </div>
    

    <?PHP
            for($j = 0; $j <$nbenfant; $j++)
            {
        ?>
<div <?php if( $pack==1 || $pack==null ) echo "style='display:none'"; else echo "style='display:'"; ?> class="card">
    <div class="card-header">
        <h3 class="card-title">Informations Enfant(<?php echo $j+1  ?>)</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- start select -->
            <div class="col-md-4">
                <div style="text-align: center;" class="form-group">
                    <label>Prénom<span>(*)</span></label>
                    <input onkeyup="ToupperENF()" name="prenom_enf[]" type="text" class="form-control prenom_enf" id="" placeholder="Prénom">
                </div>
            </div>
            <!-- end select -->   
            <div class="col-md-4">
                <div style="text-align: center;" class="form-group">
                    <label>Date Naissance<span>(*)</span></label>
                    <input onblur="tarif()" onkeyup="tarif()"  id="<?php echo $j ?>" name="date_enf[]" type="text" class="form-control dates" id="" placeholder="jj/mm/yyyy">
                </div>
            </div>
            <div class="col-md-4">
                <div style="text-align: center;" class="form-group">
                    <label>Certificat Scolaire<span>(*)</span></label>
                        <select name="Certificat[]" class="form-control Certificat " onchange="tarif()" >
                            <option value="non" >Non</option>
                            <option value="oui" >Oui</option>
                            
                        </select>
                </div>
            </div>
            
              
        </div>
    </div>
            
</div>
    <?PHP
        
        }
    ?>
    <div class="card">
    <div class="card-header">
        <h3 class="card-title">Informations Tarif</h3>
        <button  onclick="tarif()" type="button" class="btn btn-danger float-right">Calculer tarif</button>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- start select -->
            <div class="col-md-4">
                <div style="text-align: center;" class="form-group">
                    <label>Montant a payer<span></span></label>
                    <input id="Montant" value=""  name="Montant" type="text" class="form-control" id="" placeholder="">
                </div>
            </div>
            <!-- end select -->  
            <!-- start select -->
            <div class="col-md-4">
                <div style="text-align: center;" class="form-group">
                    <label>Avance<span></span></label>
                    <input id="Avance" value=""  name="Avance" type="text" class="form-control" id="" placeholder="">
                </div>
            </div>
            <!-- end select --> 
            <!-- start select -->
            <div class="col-md-4">
                <div style="text-align: center;" class="form-group">
                    <label>Mode de paiement<span>(*)</span></label>
                        <select name="Mode_p" class="form-control">
                            <option value="Cheque" >Chèque</option>
                            <option value="Virement" >Virement</option>
                            <option value="Espece" >Espèce</option>
                        </select>
                </div>
            </div>
            <!-- end select -->  
               
        </div>
        <div class="row">
            <!-- start select -->
            <div class="col-md-6">
                <div style="text-align: center;" class="form-group">
                    <label>Dètails<span></span></label>
                    <div id="Details" ></div>
                </div>
            </div>
            <!-- end select -->  
            <!-- start select -->
            <div class="col-md-6">
                <div style="text-align: center;" class="form-group">
                    <label>Observation<span></span></label>
                    <textarea class="form-control" name="" id="" cols="2" rows="2"></textarea>
                </div>
            </div>
            
               
        </div>
    </div>
            
</div>
<div  class="row justify-content-end">
    <div style="padding:15px;" class="col-ms-6">
    <input value="sauvegarder" class="btn btn-success" type="submit">
    </div>
    <div style="padding:15px;" class="col-ms-6">
    <a href="Adhesions.php"><button type="button" class="btn btn-danger">Retour</button></a>
    </div>
</div>

</form>



</div>

<?php include("footer.php") ?>

        
    </body>
</html>