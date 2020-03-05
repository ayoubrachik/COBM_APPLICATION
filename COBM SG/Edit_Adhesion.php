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
    $CIN_edit= $_GET["CIN_edit"];
    if(!isset($nbenfant))
        $nbenfant = 0;
    
        if($pack == 1)
            $nbenfant = 0;

    $sqlE="SELECT *,DATE_FORMAT(date_adhesion, '%d/%m/%Y') as date_adhesion2 FROM `adhesion` WHERE CIN = '$CIN_edit'";
    $resultE = mysqli_query($connect, $sqlE);
    $rowE = mysqli_fetch_array($resultE);

    $sqlC="SELECT * FROM `lien` WHERE CIN_chef = '$CIN_edit' && 'type' !='enfant' ";
    $resultC=mysqli_query($connect, $sqlC);
    $rowC = mysqli_fetch_array($resultC);

   
   

     
    
    
 ?>
<style>
    .col-md-4 span,.col-md-6 span
    {
    color: red;
    }
    *{
        
        font-size:13px !important;
        
    }
    
</style>
<br>


<div  onload="tarif()" class="container">
   <form action="update_Adhesion.php" method="GET" onsubmit="return valide()">
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
                        <input onkeyup="tarif();Toupper(this.id)" value="<?php echo $rowE[0]; ?>"  name="CNIE" type="text" class="form-control" id="CIN" placeholder="CNIE">
                    </div>
                </div>
                <!-- end select -->   
                <!-- start select -->
                <div  class="col-md-4 new_Adhesion">
                    <div style="text-align: center;" class="form-group">
                        <label>Nom<span>(*)</span></label>
                        <input onkeyup="Toupper(this.id)" value="<?php echo $rowE['nom']; ?>" name="Nom" type="text" class="form-control" id="nom" placeholder="Nom">
                    </div>
                </div>
                <!-- end select -->   
                <!-- start select -->
                <div class="col-md-4">
                    <div style="text-align: center;" class="form-group">
                        <label>Prenom<span>(*)</span></label>
                        <input onkeyup="Toupper(this.id)" value="<?php echo $rowE['prenom']; ?>" name="Prenom" type="text" class="form-control" id="prenom" placeholder="Prenom">
                    </div>
                </div>
                <!-- end select --> 
                <!-- start select -->
                <div class="col-md-4">
                    <div style="text-align: center;" class="form-group">
                        <label>Date Adhésion<span>(*)</span></label>
                        <input name="Date_Adhesion" value="<?php echo $rowE['date_adhesion2']; ?>"   type="text" class="form-control" id="Date_Adhesion" placeholder="jj/mm/aaaa">
                    </div>
                </div>
                <!-- end select -->  
                <!-- start select -->
                <div class="col-md-4">
                    <div style="text-align: center;" class="form-group">
                        <label>Tele<span>(*)</span></label>
                        <input value="<?php echo $rowE['tele']; ?>" name="Tele" type="text" class="form-control" id="Tele" placeholder="Tele">
                    </div>
                </div>
                <!-- end select -->  
                <!-- start select -->
                <div class="col-md-4">
                    <div style="text-align: center;" class="form-group">
                        <label>Email</label>
                        <input value="<?php echo $rowE['email']; ?>" name="Email" type="text" class="form-control" id="Email" placeholder="Email">
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
                            <select onchange="change_sexe()" id="Conjoint" name="Type_Conjoint" class="form-control Certificat ">
                                <option <?php if($rowC['type']=="époux") echo 'selected'  ?> value="époux" >époux</option>
                                <option <?php if($rowC['type']=="épouse") echo 'selected'  ?> value="épouse" >épouse</option>
                                <option <?php if($rowC['type']=="pére") echo 'selected'  ?> value="pére" >pére</option>
                                <option <?php if($rowC['type']=="mére") echo 'selected'  ?> value="mére" >mére</option>
                                <option <?php if($rowC['type']=="frére") echo 'selected'  ?> value="frére" >frére</option>
                                <option <?php if($rowC['type']=="sœur") echo 'selected'  ?> value="sœur" >sœur</option>
                            </select>
                    </div>
                </div>
                    <!-- start select -->
                    <div class="col-md-5">
                        <div style="text-align: center;" class="form-group">
                            <label id="nom_epou2" >Nom époux <span>(*)</span></label>
                            <input value="<?php echo $rowC['nom']; ?>" onkeyup="Toupper(this.id)" type="text" name="Nom_Conjoint" class="form-control" id="nom_epou" placeholder="">
                        </div>
                    </div>
                    <!-- end select -->   
                    <!-- start select -->
                    <div class="col-md-5">
                        <div style="text-align: center;" class="form-group">
                            <label id="prenom_epou" >Prenom époux <span>(*)</span></label>
                            <input value="<?php echo $rowC['prenom']; ?>" onkeyup="Toupper(this.id)" name="Prenom_Conjoint"  type="text" class="form-control" id="Prenom_epou" placeholder="">
                        </div>
                    </div>
                    <!-- end select -->   
                </div>
            </div>
        </div>
        
   
        <?PHP
                
                    $sqlEnf="SELECT *, DATE_FORMAT(date_naissance,'%d/%m/%Y') as date_naissance2 FROM `lien` WHERE CIN_chef = '$CIN_edit' && type ='enfant' ";
                    $resultEnf=mysqli_query($connect, $sqlEnf);
                    $j=0;
                    while($rowEnf=mysqli_fetch_assoc($resultEnf))
                    {$j++;

            ?>
    <div <?php if( $pack==1 || $pack==null ) echo "style='display:none'"; else echo "style='display:'"; ?> class="card">
        <div class="card-header">
            <h3 class="card-title">Informations Enfant(<?php echo $j  ?>)</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- start select -->
                <div class="col-md-4">
                    <div style="text-align: center;" class="form-group">
                        <label>Prénom<span>(*)</span></label>
                        <input value="<?php echo $rowEnf['prenom'];?>" onkeyup="ToupperENF()" name="prenom_enf[]" type="text" class="form-control prenom_enf" id="" placeholder="Prénom">
                    </div>
                </div>
                <!-- end select -->   
                <div class="col-md-4">
                    <div style="text-align: center;" class="form-group">
                        <label>Date Naissance<span>(*)</span></label>
                        <input value="<?php echo $rowEnf['date_naissance2'];?>" onblur="tarif()" onkeyup="tarif()"  id="" name="date_enf[]" type="text" class="form-control dates"  placeholder="jj/mm/yyyy">
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="text-align: center;" class="form-group">
                        <label>Certificat Scolaire<span>(*)</span></label>
                            <select name="Certificat[]" class="form-control Certificat ">
                                <option <?php if($rowEnf['certificat']=="non") echo 'selected' ?> value="non" >Non</option>
                                <option <?php if($rowEnf['certificat']=="oui") echo 'selected' ?> value="oui" >Oui</option>
                                
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
                <div class="col-md-3">
                    <div style="text-align: center;" class="form-group">
                        <label>Montant a payer<span></span></label>
                        <input id="Montant" value="<?php echo $rowE['montant_avance']+$rowE['montant_recete']; ?>"  name="Montant" type="text" class="form-control" id="" placeholder="">
                    </div>
                </div>
                <!-- end select --> 
                <!-- start select -->
                <div class="col-md-3">
                    <div style="text-align: center;" class="form-group">
                        <label>payer<span></span></label>
                        <input id="Payer" value="<?php echo $rowE['montant_avance']; ?>"  name="Avance" type="text" class="form-control" id="" placeholder="">
                    </div>
                </div>
                <!-- end select --> 
                <div class="col-md-3">
                    <div style="text-align: center;" class="form-group">
                        <label>Reste<span></span></label>
                        <input id="rester" value="<?php echo  $rowE['montant_recete']; ?>"  name="rester" type="text" class="form-control" id="" placeholder="">
                    </div>
                </div>
                <!-- start select -->
                <div class="col-md-3">
                    <div style="text-align: center;" class="form-group">
                        <label>Mode de paiement<span>(*)</span></label>
                            <select name="Mode_p" class="form-control">
                                <option <?php if($rowE['mode_paiment']=="Cheque") echo 'selected' ?>  value="Cheque" >Chèque</option>
                                <option <?php if($rowE['mode_paiment']=="Virement") echo 'selected' ?> value="Virement" >Virement</option>
                                <option <?php if($rowE['mode_paiment']=="Espece") echo 'selected' ?>  value="Espece" >Espèce</option>
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
        <input  value="sauvegarder" class="btn btn-success" type="submit">
        </div>
        <div style="padding:15px;" class="col-ms-6">
        <a href="Adhesions.php"><button type="button" class="btn btn-danger">Retour</button></a>
        </div>
    </div>
    <input style="display:none" type="text" name='CIN_origine' value="<?php echo $_GET['CIN_edit'] ?>" >
    <input style="display:none" type="text" name='pack' value="<?php echo $_GET['pack'] ?>" >
    <input style="display:none" type="text" name='Abonn' value="<?php echo $_GET['Abonn'] ?>" >
    <input style="display:none" type="text" name='nbenfant' value="<?php echo $_GET['nbenfant'] ?>" >
    
    </form>
    
    
    
</div>

<?php include("footer.php") ?>
            