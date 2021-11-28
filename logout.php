<?php ob_start();
header("Content-type: text/html; charset=utf-8");  
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php

session_start();

if($_SESSION['loggedin']){      // ha be van jelentkezve a felhasználó...
    session_destroy();          // kilépteti őt (sessionváltozók törlése)
    header("Location: login.php"); // és átirányítja a login oldalra
} 

?>
</body>
</html>