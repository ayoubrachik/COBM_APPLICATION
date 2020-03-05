<?php include("header.php") ?>
<?php include("db_connect.php") ?>
<?php 

  $sql1="select count(*) from adhesion where ID_adhesion = 0";
  $result1= mysqli_query($connect, $sql1);
  $row1 = mysqli_fetch_array($result1);
  
  if($row1[0]==0)
  {
    $sql2="INSERT INTO `adhesion`(`CIN`, `ID_adhesion`, `nom`, `prenom`, `date_adhesion`, `date_fin`, `ID_pack`, `ID_abonnement`, `montant_avance`, `montant_recete`, `tele`, `email`, `nbenfant`, `mode_paiment`) VALUES 
    ('0',0,'passager','passager','','',4,1,0,0,'','','','')";
    $result2= mysqli_query($connect, $sql2);
   
  }


?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Adhesions</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Adhesions</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <div class="container-fluid">
        <div style="margin-left: 60px;" class="row">
        <div class="col-md-3">
                <div style="text-align: center;" class="form-group">
                    <label  >état de l'abonnement:</label>
                        <select id="filter" class="form-control">
                            <option selected='selected' value="tous" >tous</option>
                            <option value="valable" >valable</option>
                            <option value="expire" >expiré</option>
                            
                        </select>
                    
                  </div>
            </div>
            <div class="col-md-3">
                <div style="text-align: center;" class="form-group">
                    <label  >trier par :</label>
                        <select id="trier" class="form-control">
                            <option selected value="date" >date d'insertion</option>
                            <option value="alpha" >alphabet</option>
                        </select>
                    
                  </div>
            </div>
            <div style="text-align: center;" class="col-md-6">
                <label>Actions:</label>
                <div>
                        <button type="button" class="btn btn-primary">Rechercher</button>
                        <a href="new_Adhesion.php"><button type="button" class="btn btn-success">Nouvelle Adhésion</button></a>
                        <button type="button" class="btn btn-warning">Success</button>
                </div>
            </div>
        </div>
        
        
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">List Des Adhesions</h3>
            </div>
            <div style="margin-top: 20px; margin-left: 20px; " class="row">
                <div class="col-sm-6 col-md-6">
                    <label for="">Afficher</label> 
                    <select name="" id="">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                     </select>
                     <label for="">Adhesion</label>
                </div>
                <div class="col-sm-6 col-md-6">
                    <label for="">Rechercher</label>
                    <input id="search_text" name="search_text" class=""  type="text">
                </div>
            </div>
            <!-- /.card-header -->
              
            <div id="table_res" class="card-body">
              
            </div>

          <script>
          //id="date_dd"
          $(document).ready(function(){
            load_data();
            function load_data(query,filter,trier,date_dd,date_ff)
            {
              $.ajax({
                url:"action.php",
                method:"post",
                data:{query:query,filter:filter,trier:trier,date_dd:date_dd,date_ff:date_ff},
                success:function(data)
                {
                  $('#table_res').html(data);
                }
              });
            }
            //
            
            //
            $('#search_text').keyup(function(){
              var search = $(this).val();
              var search2=$("#filter").val();
              var search3=$("#trier").val();
              var search4=$('#date_dd').val();
              var search5=$('#date_ff').val();
              if(search != '')
              {
                load_data(search,search2,search3,search4,search5);
              }
              else
              {
                load_data("",search2,search3,search4,search5);			
              }
            });
            //
            $('#filter').change(function(){
              var search = $("#search_text").val();
              var search2=$(this).val();
              var search3=$("#trier").val();
              var search4=$('#date_dd').val();
              var search5=$('#date_ff').val();
              if(1)
              {
                load_data(search,search2,search3,search4,search5);
              }
              else
              {
                load_data();			
              }
            });
            //
            $('#trier').change(function(){
              var search = $("#search_text").val();
              var search2=$("#filter").val();
              var search3=$(this).val();
              var search4=$('#date_dd').val();
              var search5=$('#date_ff').val();
              if(1)
              {
                load_data(search,search2,search3,search4,search5);
              }
              else
              {
                load_data();			
              }
            });
            //
            $('#date_dd').keyup(function(){
              var search = $("#search_text").val();
              var search2=$("#filter").val();
              var search3=$("#trier").val();
              var search4=$(this).val();
              var search5=$('#date_ff').val();
              if(search != '')
              {
                load_data(search,search2,search3,search4,search5);
              }
              else
              {
                load_data("",search2,search3,search4,search5);			
              }
            });
            //
            $('#date_ff').keyup(function(){
              var search = $("#search_text").val();
              var search2=$("#filter").val();
              var search3=$("#trier").val();
              var search4=$('#date_dd').val();
              var search5=$(this).val();
              if(search != '')
              {
                load_data(search,search2,search3,search4,search5);
              }
              else
              {
                load_data("",search2,search3,search4,search5);			
              }
            });
            //
            
            //
          });
</script>
<?php include("footer.php") ?>