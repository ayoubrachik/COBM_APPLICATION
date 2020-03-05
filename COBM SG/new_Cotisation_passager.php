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














$sql1= "select ID_adhesion,CIN,nom,prenom from adhesion";

$result1= mysqli_query($connect,$sql1);

/*$pack=$_GET["pack"];
$nbenfant=$_GET["nbenfant"];
$Abonn=$_GET["Abonn"];

if(!isset($nbenfant))
    $nbenfant = 0;

    if($pack == 1)
        $nbenfant = 0;*/


    

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
<form action="insert_cotisation_passager.php">
<?php for($i=0;$i<3;$i++) { 
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

    $sql_Tennis="select * from activite where type = 'Ecole de Tennis passager' ";
    $result_Tennis = mysqli_query($connect,$sql_Tennis);

    $sql_Equitation="select * from activite where type = 'Ecole de Equitation passager' ";
    $result_Equitation = mysqli_query($connect,$sql_Equitation);


    $sql_Sport="select * from activite where type = 'Salle de sport passager' ";
    $result_Sport = mysqli_query($connect,$sql_Sport);

    $sql_Foot="select * from activite where type = 'Ecole de football passager' ";
    $result_Foot = mysqli_query($connect,$sql_Foot);


        

   

    
    
    ?>
<!-- start Cotisation card -->
<div class="card-info">
    <div class="card-header">
        <h3 class="card-title">Cotisation Passager</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- start select -->
            <div class="col-md-2">
                <div style="text-align: center;" class="form-group">
                    <label>Nom<span>(*)</span></label>
                    <input value=""  name="Nom[]" type="text" class="form-control" id="" placeholder="">
                </div>
            </div>
            <div class="col-md-2">
                <div style="text-align: center;" class="form-group">
                    <label>Prénom<span>(*)</span></label>
                    <input value=""  name="Prenom[]" type="text" class="form-control" id="" placeholder="">
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
                        <option value="<?php echo $row_tennis[0];?>"> <?php echo $row_tennis['intitule'].": "; echo $row_tennis['montant']." ";echo $row_tennis['paiment']?>  </option>
                    <?php endwhile;?>
                            
                    </select>
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
                        <option value="<?php echo $row_Equitation[0];?>"> <?php echo $row_Equitation['intitule'].": "; echo $row_Equitation['montant']." ";echo $row_Equitation['paiment']?>  </option>
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

<!--Conjoint -->


<div  class="row justify-content-end">
    <div style="padding:15px;" class="col-ms-6">
    <input value="sauvegarder" class="btn btn-success" type="submit">
    </div>
    <div style="padding:15px;" class="col-ms-6">
    <a href="cotisation.php"><button type="button" class="btn btn-danger">Retour</button></a>
    </div>
</div>
    
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

        