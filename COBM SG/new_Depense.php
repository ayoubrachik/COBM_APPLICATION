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














$sql1= "select * from type_depense";

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
    
    font-size:11px !important;
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
<form action="insert_depense.php">

<!-- start Cotisation card -->
<div class="row justify-content-center ">
        <div class="col-md-6">
            <div class="card-info">
                <div class="card-header">
                    <h3 class="card-title">Nouvelle Depense</h3>
                </div>
                <div class="card-body">
                    <div  class="form-group">
                        <label>Type Depense<span>(*)</span></label>
                        <select class="js-example-basic-single form-control " name="ID_depense">
                            <option value="0" disabled selected >selectionner Type Depense</option>
                            <?php while($row1= mysqli_fetch_array($result1)):;?>
                            <option value="<?php echo $row1['ID_type'];?>"> <?php echo $row1['type'];?>  </option>
                            <?php endwhile;?>
                        </select>
                    </div>
                    <div  class="form-group">
                        <label>Mode de paiement<span>(*)</span></label>
                        <select id="" name="mode_p" class="form-control" >
                            <option value="Cheque" >Chèque</option>
                            <option value="Virement" >Virement</option>
                            <option value="Espece" >Espèce</option>
                        </select>
                    </div>
                    <div  class="form-group">
                        <label>Numéro chéque<span>(*)</span></label>
                        <input name="num_cheque"  type="text" class="form-control" >
                    </div>
                    <div  class="form-group">
                        <label>Montant<span>(*)</span></label>
                        <input name="montant" type="text" class="form-control" >
                    </div>
                    <div  class="form-group">
                        <label>Date<span>(*)</span></label>
                        <input name="date" type="text" class="form-control" placeholder="jj/mm/aaaa" >
                    </div>
                    <div  class="form-group">
                        <label>Description<span></span></label>
                        <textarea name="description" class="form-control" name="" id="" cols="10" rows="4"></textarea>
                    </div>
                            <div  class="row justify-content-end">
                            <div style="padding:15px;" class="col-ms-6">
                            <input value="sauvegarder" class="btn btn-success" type="submit">
                            </div>
                            <div style="padding:15px;" class="col-ms-6">
                            <a href="Depenses.php"><button type="button" class="btn btn-danger">Retour</button></a>
                            </div>
                </div>
                </div>
                        
            </div>
        </div>
</div>

</div>



<!--Conjoint -->



    
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

        