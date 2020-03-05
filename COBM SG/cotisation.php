<?php include("header.php") ?>
<?php include("db_connect.php") ?>
<?php 

    $sql1 .= "SELECT C.ID_cotisation as 'ID_cotisation', A.nom as 'nom_adh',A.prenom as 'prenom_adh', A.CIN as 'CIN_adh',P.type_pack as 'pack',AB.type_Abonnement as 'abonn',L.prenom as 'prenom_member' ,L.nom as 'nom_member',
    AC.type as 'type_act',AC.intitule as 'intitule_act',C.montant as 'montant', DATE_FORMAT(C.date_debut, '%d/%m/%Y')  as 'date_debut',C.date_fin as 'date_fin' ,DATE_FORMAT(C.date_fin, '%d/%m/%Y') as 'date_fin2',C.ID_adhesion as 'ID_adhesion',C.ID_lien as 'ID_lien'
    from cotisation C INNER JOIN adhesion A on C.ID_adhesion = A.ID_adhesion INNER join lien L on C.ID_lien=L.ID_lien INNER JOIN activite AC on C.ID_activite = AC.id_activite INNER JOIN
    packs P on A.ID_pack = P.ID INNER JOIN abonnement AB on A.ID_abonnement = AB.ID";
    
    
    $trier=$_GET['trier'];
    $etat=$_GET['etat'];
    $x='<';
    $y='>';

    if(!isset($trier))
    $trier='date';
    if(!isset($etat))
    $etat='tous';
    if($etat=="valable")
    {
        $sql1 .= " AND CURDATE() $x C.date_fin ";
    }
    else if($etat=="expire")
    {
        $sql1 .= " AND CURDATE() $y C.date_fin ";
    }
    else if($etat=="tous")
    {
        $sql1 = "SELECT C.ID_cotisation as 'ID_cotisation', A.nom as 'nom_adh',A.prenom as 'prenom_adh', A.CIN as 'CIN_adh',P.type_pack as 'pack',AB.type_Abonnement as 'abonn',L.prenom as 'prenom_member' ,L.nom as 'nom_member',
        AC.type as 'type_act',AC.intitule as 'intitule_act',C.montant as 'montant', DATE_FORMAT(C.date_debut, '%d/%m/%Y')  as 'date_debut',C.date_fin as 'date_fin' ,DATE_FORMAT(C.date_fin, '%d/%m/%Y') as 'date_fin2',C.ID_adhesion as 'ID_adhesion',C.ID_lien as 'ID_lien'
        from cotisation C INNER JOIN adhesion A on C.ID_adhesion = A.ID_adhesion INNER join lien L on C.ID_lien=L.ID_lien INNER JOIN activite AC on C.ID_activite = AC.id_activite INNER JOIN
        packs P on A.ID_pack = P.ID INNER JOIN abonnement AB on A.ID_abonnement = AB.ID";
    }
    if($trier=="date")
    {
        $sql1 .=" ORDER by C.ID_cotisation DESC";
    }
    else if($trier=="alpha")
    {
        $sql1 .=" ORDER by A.nom";
    }

    $result1 = mysqli_query($connect, $sql1);
    //echo $sql1;

?>
<style>
    td{
        padding:0px !important;
    }
    
    *{
        
        font-size:12px !important;
        font-weight: 600;
       
        
    }
</style>


    <script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
    <!-- Content Header (Page header) -->


    
    <!-- /.content-header -->

    <!-- Main content -->

    <div class="container-fluid">
        <div style="margin-left: 60px;" class="row">
        <div class="col-md-3">
                <div style="text-align: center;" class="form-group">
                    <label  >état de l'abonnement:</label>
                    <select id="filter" name="etat" class="form-control" onchange="window.location.href='cotisation.php?trier=<?PHP echo $trier; ?>&etat='+this.value" >
                            <option <?php if($etat=='tous') echo 'selected=selected'; ?> value="tous" >tous</option>
                            <option <?php if($etat=='valable') echo 'selected=selected'; ?> value="valable" >valable</option>
                            <option <?php if($etat=='expire') echo 'selected=selected'; ?> value="expire" >expiré</option>
                            
                        </select>
                    
                  </div>
            </div>
            <div class="col-md-3">
                <div style="text-align: center;" class="form-group">
                    <label  >trier par :</label>
                    <select id="trier" name="trier" class="form-control" onchange="window.location.href='cotisation.php?etat=<?PHP echo $etat; ?>&trier='+this.value" >
                            <option <?php if($trier=='date') echo 'selected=selected'; ?> value="date" >date d'insertion</option>
                            <option <?php if($trier=='alpha') echo 'selected=selected'; ?> value="alpha" >alphabet</option>
                        </select>
                    
                  </div>
            </div>
            <div style="text-align: center;" class="col-md-6">
                <label>Actions:</label>
                <div>
                        <a href="new_Cotisation.php"><button type="button" class="btn btn-success">Nouvelle Cotisation</button></a>
                        <a href="new_Cotisation_passager.php"><button type="button" class="btn btn-info">Passager</button></a>
                        <button type="button" class="btn btn-warning">Success</button>
                </div>
            </div>
        </div>
        
        
            <!-- /.card-header -->
            <?php 
                $output .= '
                <table id="myTable" class=" table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>Nom</th>
                              <th>Prenom</th>
                              <th>CIN</th>
                              <th>Pack</th>
                              <th>Abonnement</th>
                              <th>Members</th>
                              <th>Activite</th>
                              <th>montant</th>
                              <th>Date debut</th>
                              <th>Date fin</th>
                              <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>';
            
                            while($row1 = mysqli_fetch_array($result1))
                            {
                                    $className;
                                    if(date("Y-m-d")>$row1['date_fin'])
                                    $className='date_fin_expire';
                                    else
                                    $className='date_fin_active';
            
            
                                
                                $output .= '
                                    <tr>
                                        <td>'.$row1["nom_adh"].'</td>
                                        <td>'.$row1["prenom_adh"].'</td>
                                        <td>'.$row1["CIN_adh"].'</td>
                                        <td>'.$row1["pack"].'</td>
                                        <td>'.$row1["abonn"].'</td>
                                        <td>'.$row1["prenom_member"]." ".$row1["nom_member"].'</td>
                                        <td>'.$row1["type_act"]."-".$row1["intitule_act"].'</td>
                                        <td>'.$row1["montant"].'</td>
                                        
                                        <td>'.$row1["date_debut"].'</td>
                                        <td>'.
                                            '<span class="'.$className.'">'.$row1["date_fin2"].'</span>'.
                                        '</td>
                                        
                                    
                                ';
                                     
                                    
                                    
            
                                     
                                    
                                    $ID_cotisation_del=$row1['ID_cotisation'];
                                    
                                    
                                    $output .= "<td><a  href='#'><i class='fas fa-print'></i></a>";
                                    $output .= "<a href='"."Edit_Adhesion.php?Abonn=".$row1["ID_abonnement"]."&pack=".$row1["ID_pack"].'&nbenfant='.$row1['nbenfant']."&CIN_edit=".$row1['CIN']."'><i class='fas fa-pencil-alt'></i></a>";
                                    $output .= "<a onclick='deleting2(`$ID_cotisation_del`)' href='#'><i class='fas fa-trash-alt'></i></a></td>";
                                    $output .= "</tr>";
                                
                            }
                echo $output;
            
            ?>
              
            

          <script>
         
         $(document).ready( function () {
            $('#myTable').DataTable();
        } );
                
</script>
</div>
  <!-- /.content-wrapper -->
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->

<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!--bootstraptoggle-->
<script src="plugins/bootstraptoggle/bootstrap-toggle.min.js" ></script>
<link href="plugins/dark.min.css" rel="stylesheet">
<script src="plugins/sweetalert2.min.js"></script>
<!--select2-->
    <link href="plugins/select3/select2.min.css" rel="stylesheet">
    <script src="plugins/select3/select2.min.js"></script>

<script src="main2.js" ></script>
    <script src="maintest.js" ></script>
    


<script>
  
   document.getElementById("dd").click();
   
</script>
</body>
</html>
