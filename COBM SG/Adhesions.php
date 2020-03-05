<?php include("header.php") ?>
<?php include("db_connect.php") ?>
<?php 

    $trier=$_GET['trier'];
    $etat=$_GET['etat'];
    $x='<';
    $y='>';

    if(!isset($trier))
    $trier='date';
    if(!isset($etat))
    $etat='tous';


    $sqlE="select count(*) from adhesion where ID_adhesion = 0";
    $resultE= mysqli_query($connect, $sqlE);
    $rowE = mysqli_fetch_array($resultE);

    $sqlE="select count(*) from adhesion where ID_adhesion = 0";
    $resultE= mysqli_query($connect, $sqlE);
    $rowE = mysqli_fetch_array($resultE);

  
  if($rowE[0]==0)
  {
    $sqlC="INSERT INTO `adhesion`(`CIN`, `ID_adhesion`, `nom`, `prenom`, `date_adhesion`, `date_fin`, `ID_pack`, `ID_abonnement`, `montant_avance`, `montant_recete`, `tele`, `email`, `nbenfant`, `mode_paiment`) VALUES 
    ('0',0,'passager','passager','','',4,1,0,0,'','','','')";
    $resultC= mysqli_query($connect, $sqlC);
   
  }

  //lien chef
    $sqlL="select count(*) from lien where ID_lien = 0";
    $resultL= mysqli_query($connect, $sqlL);
    $rowL = mysqli_fetch_array($resultL);
    if($rowL[0]==0)
  {
    $sqlL="INSERT INTO `lien` (`ID_lien`, `nom`, `prenom`, `type`, `date_naissance`, `ID_adhesion`) VALUES ('0', 'de famaille ', 'CHEF', 'chef', NULL, '');";
    $resultL= mysqli_query($connect, $sqlL);
   
  }
    





    $sql1 = "SELECT * ,DATE_FORMAT(date_adhesion, '%d/%m/%Y') as date_adhesion2, DATE_FORMAT(date_fin, '%d/%m/%Y') as date_fin2 ,P.type_pack,Ab.type_Abonnement FROM
    adhesion A inner JOIN packs P on A.ID_pack=P.ID inner JOIN abonnement Ab on A.ID_abonnement=Ab.ID where ID_adhesion > 0  ";

    if($etat=="valable")
    {
        $sql1 .= " AND CURDATE() $x date_fin  and ID_adhesion > 0";
    }
    else if($etat=="expire")
    {
        $sql1 .= " AND CURDATE() $y date_fin and ID_adhesion > 0 ";
    }
    else if($etat=="tous")
    {
        $sql1 = "SELECT * ,DATE_FORMAT(date_adhesion, '%d/%m/%Y') as date_adhesion2, DATE_FORMAT(date_fin, '%d/%m/%Y') as date_fin2 ,P.type_pack,Ab.type_Abonnement FROM
         adhesion A inner JOIN packs P on A.ID_pack=P.ID inner JOIN abonnement Ab on A.ID_abonnement=Ab.ID where ID_adhesion > 0  ";
    }
    if($trier=="date")
    {
        $sql1 .=" ORDER by ID_adhesion";
    }
    else if($trier=="alpha")
    {
        $sql1 .=" ORDER by nom";
    }
    $result1 = mysqli_query($connect, $sql1);
    

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
  <link rel="stylesheet" href="main.css">
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
    <!-- Content Header (Page header) -->
    
    <!-- /.content-header -->

    <!-- Main content -->

    <div class="container-fluid">
        <div style="margin-left: 60px;" class="row">
        <div class="col-md-3">
                <div style="text-align: center;" class="form-group">
                    <label  >état de l'abonnement:</label>
                        <select id="filter" name="etat" class="form-control" onchange="window.location.href='Adhesions.php?trier=<?PHP echo $trier; ?>&etat='+this.value" >
                            <option <?php if($etat=='tous') echo 'selected=selected'; ?> value="tous" >tous</option>
                            <option <?php if($etat=='valable') echo 'selected=selected'; ?> value="valable" >valable</option>
                            <option <?php if($etat=='expire') echo 'selected=selected'; ?> value="expire" >expiré</option>
                            
                        </select>
                    
                  </div>
            </div>
            <div class="col-md-3">
                <div style="text-align: center;" class="form-group">
                    <label  >trier par :</label>
                        <select id="trier" name="trier" class="form-control" onchange="window.location.href='Adhesions.php?etat=<?PHP echo $etat; ?>&trier='+this.value" >
                            <option <?php if($trier=='date') echo 'selected=selected'; ?> value="date" >date d'insertion</option>
                            <option <?php if($trier=='alpha') echo 'selected=selected'; ?> value="alpha" >alphabet</option>
                        </select>
                    
                  </div>
            </div>
            <div style="text-align: center;" class="col-md-6">
                <label>Actions:</label>
                <div>
                        
                        <a href="new_Adhesion.php"><button type="button" class="btn btn-success">Nouvelle Adhésion</button></a>
                        <button type="button" class="btn btn-warning">Expoert vers MS Excel</button>
                </div>
            </div>
        </div>

        <?php 
        
        $output .= '
        <table id="myTable" class="  table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Prenom</th>
                      <th>CIN</th>
                      <th>Members	</th>
                      <th>Pack</th>
                      <th>Abonnement</th>
                      <th>Avance</th>
                      <th>Reste</th>
                      <th>Mode paiment</th>
                      <th>Date debut	</th>
                      <th>Date fin</th>
                      <th>Tele</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>';
    
                    while($row1 = mysqli_fetch_array($result1))
                    {
                        $output .= '
                            <tr>
                                <td>'.$row1["nom"].'</td>
                                <td>'.$row1["prenom"].'</td>
                                <td>'.$row1["CIN"].'</td>
                            
                        ';
                             $ID_adhesion=$row1["ID_adhesion"];
                            $sql2="SELECT *, DATE_FORMAT(date_naissance, '%d/%m/%Y') as date_naissance2
                                FROM `lien` where ID_adhesion='$ID_adhesion'";
                            $result2=mysqli_query($connect,$sql2);

                            $sql_count="SELECT count(*) from lien where ID_adhesion='$ID_adhesion' ";
                            $res_count=mysqli_query($connect,$sql_count);
                            $row_count=mysqli_fetch_array($res_count);

                        

                            if($row_count[0]>0)
                            {
                                $output .=' <td class="sec_table2" >
                                <table class="sec_table" > 
                                    <thead> 
                                        <tr> 
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Type</th>
                                        <th>Date naissance</th>
                                        </tr>
                                    </thead>
                                <tbody>';
                           

                            

                            
                            while($row2=mysqli_fetch_assoc($result2))
                              {
                                $output .= '<tr> <td>'.$row2["nom"].' </td><td>'.$row2["prenom"].'</td>'.'<td>'.$row2["type"].'</td><td>'.$row2["date_naissance2"].'</td> </tr>';
                              }
                              $output .= ' </tbody> </table> </td> ';
                            } 
                            else
                            {
                                $output .= '<td> SANS Members  </td> ';
                            }

                            $className;
                            if(date("Y-m-d")>$row1['date_fin'])
                            $className='date_fin_expire';
                            else
                            $className='date_fin_active';
                            $ID_del=$row1['ID_adhesion'];
                            

                            $output .= "<td>".$row1["type_pack"]."</td><td>".$row1["type_Abonnement"]."</td><td>".$row1["montant_avance"]."</td><td>".$row1["montant_recete"]."</td><td>".$row1["mode_paiment"]."</td><td>".$row1["date_adhesion2"]."</td><td><span class='$className' >".$row1['date_fin2']."</span></td><td>".$row1["tele"]."</td>";
                            $output .= "<td><a  href='Adhesion_print.php?ID_adhesion=$ID_del' target='_blank' ><i class='fas fa-print'></i></a>";
                            $output .= "<a href='"."Edit_Adhesion.php?Abonn=".$row1["ID_abonnement"]."&pack=".$row1["ID_pack"].'&nbenfant='.$row1['nbenfant']."&CIN_edit=".$row1['CIN']."'><i class='fas fa-pencil-alt'></i></a>";
                            $output .= "<a onclick='deleting(`$ID_del`)' href='#'><i class='fas fa-trash-alt'></i></a></td>";
                            $output .= "</tr>";
                        
                    }
        echo $output;
        
        
        ?>
        
        
        
            <!-- /.card-header -->
           
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
