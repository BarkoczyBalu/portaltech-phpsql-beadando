<?php  
header("Content-type: text/html; charset=utf-8");  
?> 
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Connect</title>
</head>
<body>
<h1>
<?php
/*kapcsolat felépítése */
$adatbazis='blan_H0E9DL';
$kapcsolat = mysqli_connect("127.0.0.1", "blan_H0E9DL", "Hfe3_56");
if (!$kapcsolat){
die('Nem lehet csatlakozni a MySQL kiszolgálóhoz! '.mysqli_error());
}
else{
print "Sikerült csatlakozni.<br>";}
/*Adatbázis kiválasztása*/
mysqli_select_db( $kapcsolat, $adatbazis ) 
or die ( "Nem lehet megnyitni a következő adatbázist: $adatbazis".mysqli_error());
print "Sikeresen kiválasztott adatbázis: " .$adatbazis."<br>";
?>
</h1>
</body>
</html>