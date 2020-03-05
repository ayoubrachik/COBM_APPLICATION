
<?php

    
    include("header.php");
    include("db_connect.php");

        function get_age($birthday)
            {
                list($year, $month, $day) = explode("-", $birthday);
                $year_diff  = date("Y") - $year;
                $month_diff = date("m") - $month;
                $day_diff   = date("d") - $day;
                if($month_diff < 0)
                {
                    $year_diff--;
                }
                else if(($month_diff == 0) && ($day_diff < 0))
                {
                    $year_diff--;
                }
                return $year_diff;
            }














    $sql1= "select ID_adhesion,CIN,nom,prenom from adhesion where ID_adhesion>0";
   
    $result1= mysqli_query($connect,$sql1);

    /*$pack=$_GET["pack"];
    $nbenfant=$_GET["nbenfant"];
    $Abonn=$_GET["Abonn"];

    if(!isset($nbenfant))
        $nbenfant = 0;
    
        if($pack == 1)
            $nbenfant = 0;*/

   if(isset($_GET['ID_adhesion']))
   {
        $ID_adhesion=$_GET['ID_adhesion'];
        $sql2= "select nom,prenom,ID_adhesion from adhesion where ID_adhesion='$ID_adhesion'";
        $result2= mysqli_query($connect,$sql2);
        $row2=mysqli_fetch_array($result2);


        //
        $sql3= "select nom,prenom,date_naissance,ID_lien from lien where ID_adhesion='$ID_adhesion' && type!='enfant'";
        $result3= mysqli_query($connect,$sql3);
        //
        $sql4= "select nom,prenom,date_naissance,ID_lien from lien where ID_adhesion='$ID_adhesion' && type='enfant'";
        $result4= mysqli_query($connect,$sql4);

        $sql_Tennis="select * from activite where type = 'Ecole de Tennis' ";
        $result_Tennis = mysqli_query($connect,$sql_Tennis);

        $sql_Equitation="select * from activite where type = 'Ecole de Equitation' ";
        $result_Equitation = mysqli_query($connect,$sql_Equitation);


        $sql_Sport="select * from activite where type = 'Salle de sport' ";
        $result_Sport = mysqli_query($connect,$sql_Sport);

        $sql_Foot="select * from activite where type = 'Ecole de football' ";
        $result_Foot = mysqli_query($connect,$sql_Foot);


            


   }         
    
    
 ?>
<style>
    .col-md-4 span,.col-md-6 span
    {
    color: red;
    }
    
</style>
<br>
<style>
    *{
        
        font-size:10px !important;
        font-weight: bold;
       
        
    }
    .card-body{
        background:#e9f0ea;
    }
    input
    {
        font-weight: bold !important;
    }
    select{
        font-weight: bold !important;
    }
    
    
</style>

<div  onload="tarif()" class="container">
    <div class="card-warning">
        <div class="card-header">
            <h3 style="color:#ffff" class="card-title">Informations Adhérent</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- start select -->
                <div class="col-md-4">
                    <div style="text-align: center;" class="form-group">
                        <form action="insert_cotisation.php" method="GET" onsubmit="return valide2()"  >
                        <select class="js-example-basic-single form-control " name="ID_adhesion" onchange="window.location.href='new_Cotisation.php?ID_adhesion='+this.value+''">
                            <option value="0" disabled selected >selectionner Type Adhésion</option>
                            <?php while($row1= mysqli_fetch_array($result1)):;?>
                            <option value="<?php echo $row1['ID_adhesion'];?>"> <?php echo $row1['CIN'].": "; echo $row1['prenom']." ";echo $row1['nom']?>  </option>
                            <?php endwhile;?>
                        </select>
                    </div>
                </div>
                <!-- end select -->   
                <!-- start select -->
                
                <!-- end select -->    
            </div>
        </div>
                
    </div>
   
    <!-- start Cotisation card -->
    <div class="card-info">
        <div class="card-header">
            <h3 class="card-title">Cotisation Adhérent</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- start select -->
                <div class="col-md-5">
                    <div style="text-align: center;" class="form-group">
                        <label>Nom et Prénom<span>(*)</span></label>
                        <input value="<?php echo $row2['prenom']." ".$row2['nom'];  ?>"  name="Nom" type="text" class="form-control" id="" placeholder="">
                    </div>
                </div>
                <!-- end select -->   
                <!-- start select -->
                <div  class="col-md-5 new_Adhesion">
                    <div style="text-align: center;" class="form-group">
                        <label>Date Cotisation<span>(*)</span></label>
                        <input value="" name="dates[]" type="text" class="form-control" id="" placeholder="jj/mm/aaaa">
                        
                    </div>
                </div>
                
                <!-- end select -->
                <!-- start select -->
                <div class="col-md-3">
                    <div style="text-align: center;" class="form-group">
                        <label>Ecole de Tennis<span></span></label>
                        <select name="Tennis[]" class="form-control ">
                        <option value="0"  selected >selectionner type sport</option>
                        <?php while($row_tennis= mysqli_fetch_array($result_Tennis)):;?>
                        <?php if( $row_tennis['id_activite']==2 ||  $row_tennis['id_activite']==5 || $row_tennis['id_activite']==6) { ?>
                            <option value="<?php echo $row_tennis[0];?>"> <?php echo $row_tennis['intitule'].": "; echo $row_tennis['montant']." ";echo $row_tennis['paiment']?>  </option>
                            <?php } ?>
                        <?php endwhile;?>
                                
                        </select>
                        <input value="<?php  echo '0'; ?>" style="display:none;" type="text" name="IDS[]" >
                    </div>
                </div>
                <!-- end select -->  
                <!-- start select -->
                <div class="col-md-3">
                    <div style="text-align: center;" class="form-group">
                        <label>Ecole de Equitation</label>
                        <select name="Equitation[]" class="form-control">
                        <option value="0"  selected >selectionner type sport</option>
                        <?php while($row_Equitation= mysqli_fetch_array($result_Equitation)):;?>
                        <?php if( $row_Equitation['id_activite']==8 ||  $row_Equitation['id_activite']==9) { ?>
                            <option value="<?php echo $row_Equitation[0];?>"> <?php echo $row_Equitation['intitule'].": "; echo $row_Equitation['montant']." ";echo $row_Equitation['paiment']?>  </option>
                            <?php } ?>
                        <?php endwhile;?>
                        </select>
                    </div>
                </div>
                <!-- end select -->  
                <!-- start select -->
                <div class="col-md-3">
                    <div style="text-align: center;" class="form-group">
                        <label>Salle Sport</label>
                        <select name="Salle[]" class="form-control ">
                        <option value="0"  selected >selectionner type sport</option>
                        <?php while($row_Sport= mysqli_fetch_array($result_Sport)):;?>
                            <option value="<?php echo $row_Sport[0];?>"> <?php echo $row_Sport['intitule'].": "; echo $row_Sport['montant']." ";echo $row_Sport['paiment']?>  </option>
                        <?php endwhile;?>
                        </select>
                    </div>
                </div>
                <!-- end select -->  
                <!-- start select -->
                <div class="col-md-3">
                    <div style="text-align: center;" class="form-group">
                        <label>Ecole de foot</label>
                        <select name="Foot[]" class="form-control  ">
                        <option value="0"  selected >selectionner type sport</option>
                        <?php while($row_Foot= mysqli_fetch_array($result_Foot)):;?>
                            <option value="<?php echo $row_Foot[0];?>"> <?php echo $row_Foot['intitule'].": "; echo $row_Foot['montant']." ";echo $row_Foot['paiment']?>  </option>
                        <?php endwhile;?>
                        </select>
                    </div>
                </div>
                
                <!-- end select -->     
            </div>
        </div>
                
    </div>
    
    <!-- End Cotisation card  -->

    <!--Conjoint -->
    
    <?php 
     while($row3=mysqli_fetch_array($result3)){
        $result_Tennis = mysqli_query($connect,$sql_Tennis); 
        $result_Equitation = mysqli_query($connect,$sql_Equitation);
        $result_Sport = mysqli_query($connect,$sql_Sport);
        $result_Foot = mysqli_query($connect,$sql_Foot); ?>
   
    <!-- start Cotisation card -->
    <div class="card-info">
        <div class="card-header">
            <h3 class="card-title">Cotisation Conjoint</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- start select -->
                <div class="col-md-5">
                    <div style="text-align: center;" class="form-group">
                        <label>Nom et Prénom<span>(*)</span></label>
                        <input value="<?php echo $row3[0]." ".$row3[1];  ?>"  name="Nom" type="text" class="form-control" id="" placeholder="">
                    </div>
                </div>
                <!-- end select -->   
                <!-- start select -->
                <div  class="col-md-5 new_Adhesion">
                    <div style="text-align: center;" class="form-group">
                        <label>Date Cotisation<span>(*)</span></label>
                        <input value="" name="dates[]" type="text" class="form-control" id="" placeholder="jj/mm/aaaa">
                        
                    </div>
                </div>
               
                
                <!-- end select -->
                <!-- start select -->
                <div class="col-md-3">
                    <div style="text-align: center;" class="form-group">
                        <label>Ecole de Tennis<span></span></label>
                        <select name="Tennis[]" class="form-control ">
                        <option value="0"  selected >selectionner type sport</option>
                        <?php while($row_tennis= mysqli_fetch_array($result_Tennis)):;?>
                        <?php if( $row_tennis['id_activite']==2 ||  $row_tennis['id_activite']==5 || $row_tennis['id_activite']==6) { ?>
                            <option value="<?php echo $row_tennis[0];?>"> <?php echo $row_tennis['intitule'].": "; echo $row_tennis['montant']." ";echo $row_tennis['paiment']?>  </option>
                            <?php } ?>
                        <?php endwhile;?>
                                
                        </select>
                        <input value="<?php  echo $row3['ID_lien']; ?>" style="display:none;" type="text" name="IDS[]" >
                    </div>
                </div>
                <!-- end select -->  
                <!-- start select -->
                <div class="col-md-3">
                    <div style="text-align: center;" class="form-group">
                        <label>Ecole de Equitation</label>
                        <select name="Equitation[]" class="form-control">
                        <option value="0"  selected >selectionner type sport</option>
                        <?php while($row_Equitation= mysqli_fetch_array($result_Equitation)):;?>
                        <?php if( $row_Equitation['id_activite']==8 ||  $row_Equitation['id_activite']==9) { ?>
                            <option value="<?php echo $row_Equitation[0];?>"> <?php echo $row_Equitation['intitule'].": "; echo $row_Equitation['montant']." ";echo $row_Equitation['paiment']?>  </option>
                            <?php } ?>
                        <?php endwhile;?>
                        </select>
                    </div>
                </div>
                <!-- end select -->  
                <!-- start select -->
                <div class="col-md-3">
                    <div style="text-align: center;" class="form-group">
                        <label>Salle Sport</label>
                        <select name="Salle[]" class="form-control ">
                        <option value="0"  selected >selectionner type sport</option>
                        <?php while($row_Sport= mysqli_fetch_array($result_Sport)):;?>
                            <option value="<?php echo $row_Sport[0];?>"> <?php echo $row_Sport['intitule'].": "; echo $row_Sport['montant']." ";echo $row_Sport['paiment']?>  </option>
                        <?php endwhile;?>
                        </select>
                    </div>
                </div>
                <!-- end select -->  
                <!-- start select -->
                <div class="col-md-3">
                    <div style="text-align: center;" class="form-group">
                        <label>Ecole de foot</label>
                        <select name="Foot[]" class="form-control  ">
                        <option value="0"  selected >selectionner type sport</option>
                        <?php while($row_Foot= mysqli_fetch_array($result_Foot)):;?>
                            <option value="<?php echo $row_Foot[0];?>"> <?php echo $row_Foot['intitule'].": "; echo $row_Foot['montant']." ";echo $row_Foot['paiment']?>  </option>
                        <?php endwhile;?>
                        </select>
                    </div>
                </div>
                
                <!-- end select -->     
            </div>
        </div>
                
    </div>



    <?php } ?>
     <!--Enfant -->

     <?php 
     while($row4=mysqli_fetch_array($result4)){
        $result_Tennis = mysqli_query($connect,$sql_Tennis); 
        $result_Equitation = mysqli_query($connect,$sql_Equitation);
        $result_Sport = mysqli_query($connect,$sql_Sport);
        $result_Foot = mysqli_query($connect,$sql_Foot); 
        $age = get_age($row4['date_naissance']);
        ?>
   
    <!-- start Cotisation card -->
    <div class="card-info">
        <div class="card-header">
            <h3 class="card-title">Cotisation Enfant</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- start select -->
                <div class="col-md-5">
                    <div style="text-align: center;" class="form-group">
                        <label>Nom et Prénom<span>(*)</span></label>
                        <input value="<?php echo $row4[0]." ".$row4[1];  ?>"  name="Nom" type="text" class="form-control" id="" placeholder="">
                    </div>
                </div>
                <!-- end select -->   
                <!-- start select -->
                <div  class="col-md-5 new_Adhesion">
                    <div style="text-align: center;" class="form-group">
                        <label>Date Cotisation<span>(*)</span></label>
                        <input value="" name="dates[]" type="text" class="form-control" id="" placeholder="jj/mm/aaaa">
                        
                    </div>
                </div>
                
                
                <!-- end select -->
                <!-- start select -->
                <div class="col-md-3">
                    <div style="text-align: center;" class="form-group">
                        <label>Ecole de Tennis<span></span></label>
                        <select name="Tennis[]" class="form-control ">
                        <option value="0"  selected >selectionner type sport</option>
                        <?php while($row_tennis= mysqli_fetch_array($result_Tennis)):;?>
                        
                        <?php if($age>=18) { ?>
                        <?php if( $row_tennis['id_activite']==2 ||  $row_tennis['id_activite']==5 || $row_tennis['id_activite']==6) { ?>
                            <option value="<?php echo $row_tennis[0];?>"> <?php echo $row_tennis['intitule'].": "; echo $row_tennis['montant']." ";echo $row_tennis['paiment']?>  </option>
                            <?php } ?>
                            <?php } ?>

                            <?php if($age<18) { ?>
                        
                            <option value="<?php echo $row_tennis[0];?>"> <?php echo $row_tennis['intitule'].": "; echo $row_tennis['montant']." ";echo $row_tennis['paiment']?>  </option>
                            <?php } ?>
                            

                        <?php endwhile;?>
                                
                        </select>
                        <input value="<?php  echo $row4['ID_lien']; ?>" style="display:none;" type="text" name="IDS[]" >
                    </div>
                </div>
                <!-- end select -->  
                <!-- start select -->
                <div class="col-md-3">
                    <div style="text-align: center;" class="form-group">
                        <label>Ecole de Equitation</label>
                        
                        <select name="Equitation[]" class="form-control">
                        <option value="0"  selected >selectionner type sport</option>
                        <?php while($row_Equitation= mysqli_fetch_array($result_Equitation)):;?>
                        
                        <?php if($age>=18) { ?>
                        <?php if( $row_Equitation['id_activite']==8 ||  $row_Equitation['id_activite']==9) { ?>
                            <option value="<?php echo $row_Equitation[0];?>"> <?php echo $row_Equitation['intitule'].": "; echo $row_Equitation['montant']." ";echo $row_Equitation['paiment']?>  </option>
                            <?php } ?>
                            <?php } ?>

                            <?php if($age<18) { ?>
                            <?php if( $row_Equitation['id_activite']==7 ||  $row_Equitation['id_activite']==9) { ?>
                            <option value="<?php echo $row_Equitation[0];?>"> <?php echo $row_Equitation['intitule'].": "; echo $row_Equitation['montant']." ";echo $row_Equitation['paiment']?>  </option>
                            <?php } ?>
                            <?php } ?>
                        <?php endwhile;?>
                        </select>

                    </div>
                </div>
                <!-- end select -->  
                <!-- start select -->
                <div class="col-md-3">
                    <div style="text-align: center;" class="form-group">
                        <label>Salle Sport</label>
                        <select name="Salle[]" class="form-control ">
                        <option value="0"  selected >selectionner type sport</option>
                        <?php while($row_Sport= mysqli_fetch_array($result_Sport)):;?>
                            <option value="<?php echo $row_Sport[0];?>"> <?php echo $row_Sport['intitule'].": "; echo $row_Sport['montant']." ";echo $row_Sport['paiment']?>  </option>
                        <?php endwhile;?>
                        </select>
                    </div>
                </div>
                <!-- end select -->  
                <!-- start select -->
                <div class="col-md-3">
                    <div style="text-align: center;" class="form-group">
                        <label>Ecole de foot</label>
                        <select name="Foot[]" class="form-control  ">
                        <option value="0"  selected >selectionner type sport</option>
                        <?php while($row_Foot= mysqli_fetch_array($result_Foot)):;?>
                            <option value="<?php echo $row_Foot[0];?>"> <?php echo $row_Foot['intitule'].": "; echo $row_Foot['montant']." ";echo $row_Foot['paiment']?>  </option>
                        <?php endwhile;?>
                        </select>
                    </div>
                </div>
                
                <!-- end select -->     
            </div>
        </div>
                
    </div>



    <?php } ?>
     
     
    <!--end enfant-->
    <div  class="row justify-content-end">
        <div style="padding:15px;" class="col-ms-6">
        <input value="sauvegarder" class="btn btn-success" type="submit">
        </div>
        <div style="padding:15px;" class="col-ms-6">
        <a href="cotisation.php"><button type="button" class="btn btn-danger">Retour</button></a>
        </div>
    </div>
        <input style="display: none;" name="ID_adhesion2" type="text" value="<?php echo $_GET['ID_adhesion'];?>" >
    </form>
   
    
    
</div>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<script>
   $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

<?php include("footer.php") ?>

            