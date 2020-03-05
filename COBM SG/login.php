
<?php session_start();
 include("db_connect.php");

 $username=$_POST['username'];
 $password= $_POST['password'];
 $err="";



      if(isset($_SESSION["login"]) && $_SESSION["login"]=="true")
      {
        header('Location: index.php');
      }
      if(isset($_POST['username']) && isset($_POST['password']))
      {
        $sql1="select * from users where username='$username' AND passwordd='$password'";
        $res1=mysqli_query($connect,$sql1);
        $row1= mysqli_fetch_array($res1);
        if($row1['username']==$username && $row1['passwordd']==$password )
        {
          $_SESSION["login"]=="true";
          header('Location: index.php');
        }
        else
        {
          $err='user or pass incorrect';
        }
      }


        
        if($row1[0]>0)
        {
          $_SESSION["login"] = "true";
          echo 'good';
          
        }
        

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 ?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>COBM SG</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!--bootstraptoggle-->
  <link rel="stylesheet" href="plugins/bootstraptoggle/bootstrap-toggle.min.css">
  <link href="plugins/sweetalert2/dark.css" rel="stylesheet">
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!--ayoub style-->
 


 


</head>
<style>
      *{
        font-size:16px;
      }
      .col-md-6
      {
       
        margin:auto auto;
        margin-top:5%;
        
        
      }
      
</style>
        
        <div  class="col-md-6">
          <div class="login-logo">
            <img src="dist\img\AdminLTELogo.png" alt="">
          </div>
          <!-- /.login-logo -->
          <div class="card">
            <div class="card-body login-card-body">
              <p class="login-box-msg">Sign in to start your session</p>

              <form  autocomplete="off" action="login.php" method="post">
                <div class="input-group mb-3">
                  <input name="username" type="text" class="form-control" placeholder="username">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input name="password" type="password" class="form-control" placeholder="Password">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-8">
                    <div class="icheck-primary">
                      <input type="checkbox" id="remember">
                      <label for="remember">
                        Remember Me
                      </label>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    
                  </div>
                  <span style="color:red" > <?php echo $err; ?> </span>
                  <!-- /.col -->
                </div>
              </form>

              
              <!-- /.social-auth-links -->

              <p class="mb-1">
                <a href="forgot-password.html">I forgot my password</a>
              </p>
             
            </div>
            <!-- /.login-card-body -->
          </div>
        </div>
        <?php 
        
        ?>
        
<?php include("footer.php") ?>
