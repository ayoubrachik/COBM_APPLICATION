<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
  if($_SESSION["user"] == "true")
  echo 'welcome';
  else
  echo 'go out';
?>

</body>
</html>