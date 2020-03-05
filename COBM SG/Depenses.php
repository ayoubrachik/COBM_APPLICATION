<?php include("header.php") ?>
<?php include("db_connect.php") ?>
<?php 

$sql_type= "select * from type_depense";
$result_type=mysqli_query($connect,$sql_type);
$type=$_GET['type'];
if(!isset($type))
    $type='tous';

    if($type!="tous")
    {
        $sql1 .= "SELECT * FROM depense R INNER join type_depense T on R.ID_type=T.ID_type where R.ID_type= $type ";
        
    }
    else
    {
        $sql1 .= "SELECT * FROM depense R INNER join type_depense T on R.ID_type=T.ID_type ";
    }
    
    $result1=mysqli_query($connect,$sql1);


?>
<style>
    td{
        padding:0px !important;
    }
    
    *{
        
        font-size:12px !important;
        font-weight: 600;
       
        
    }
    table a
    {
        padding:5px;
        display:inline-block !important;
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
                    <label  >Type Depenses:</label>
                    <select class="js-example-basic-single form-control " name="ID_recette" onchange="window.location.href='Depenses.php?type='+this.value">
                            <option value="tous" selected >tous</option>
                            <?php while($row_type= mysqli_fetch_array($result_type)):;?>
                            <option <?php if($_GET['type']==$row_type['ID_type']) echo 'selected';  ?>  value="<?php echo $row_type['ID_type'];?>"> <?php echo $row_type['type'];?>  </option>
                            <?php endwhile;?>
                        </select>
                  </div>
            </div>
            <div class="col-md-3">
                
            </div>
            <div style="text-align: center;" class="col-md-6">
                <label>Actions:</label>
                <div>
                        <a href="new_Depense.php"><button type="button" class="btn btn-success">Nouvelle Depenses</button></a>
                        
                        <button type="button" class="btn btn-warning">Exporter vers MS Exel</button>
                </div>
            </div>
        </div>
        
        
            <!-- /.card-header -->
            <?php 
                $output .= '
                <table id="myTable" class=" table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>Type</th>
                              <th>Num Chéque</th>
                              <th>Date</th>
                              <th>Montant</th>
                              <th>Description</th>
                              <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>';
            
                            while($row1 = mysqli_fetch_array($result1))
                            {
                                $output .= '
                                    <tr>
                                        <td>'.$row1["type"].'</td>
                                        <td>'.$row1["num_cheque"].'</td>
                                        <td>'.$row1["date_depense"].'</td>
                                        <td>'.$row1["montant"].'</td>
                                        <td>'.$row1["Description"].'</td>
                                        
                                ';
                                     
                                    
                                    
            
                                     
                                    
                                    $ID_depense_del=$row1['ID_depense'];
                                    
                                    
                                    $output .= "<td><a  href='#'><i class='fas fa-print inline'></i></a>";
                                    $output .= "<a onclick='deleting4(`$ID_depense_del`)' href='#'><i class='fas fa-trash-alt inline '></i></a></td>";
                                    $output .= "</tr>";
                                
                            }
                            
                echo $output;
            
            ?>
             

          <script>
         
         $(document).ready( function () {
            $('#myTable').DataTable();
            $('.js-example-basic-single').select2();
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
