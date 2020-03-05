<?php
session_start();
 include("header.php") ?>
<?php include("db_connect.php") ?>
<?php 

$_SESSION['login']="false";

?>
<script>
   window.location.href = "login.php";
</script>