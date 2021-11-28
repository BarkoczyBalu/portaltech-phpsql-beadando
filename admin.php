<?php
ob_start();
session_start();
header("Content-type: text/html; charset=utf-8");

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin oldal</title>
</head>
<body>

<?php
if(!$_SESSION['loggedIn']){
    header("Location:login.php");
    exit;
}

require_once("connect.php");
$kapcsolat->set_charset("utf8");

$user_query = mysqli_query($kapcsolat,"SELECT * from users where FELHASZNALO_NEV = '$_SESSION[username]'");
$admin_value = mysqli_fetch_assoc($user_query)['ADMIN'];
if($admin_value != 1){
    header("Location:user.php");
    exit;
}

echo "Üdv ".$_SESSION['username']."!<br>";
?>

<a href="logout.php">Kijelentkezés</a>

<h3> Felhasználók listája</h3>
<?php
if(isset($_POST['submit_user_torol'])){
    
    $sql="DELETE FROM users WHERE user_id = '$_POST[user_torol]'";
    if(!mysqli_query($kapcsolat,$sql)){
        die(mysqli_error($kapcsolat));
    }
}

$users_query = mysqli_query($kapcsolat,"SELECT * FROM users");
?>
<form action="admin.php" method="post">
<table>
    <tr>
        <td>ID</td>
        <td>Felhasználónév</td>
        <td>Név</td>
        <td>Jelszó</td>
        <td>Születési dátum</td>
        <td>Nem</td>
        <td>Email</td>
        <td>Végzettég</td>
        <td>Érdeklődés</td>
        <td>Admin</td>
        <td>Felhasználó törlése</td>
     </tr>
<?php
    while($users_row = mysqli_fetch_assoc($users_query)){
?>
    <tr>
        <td><?php echo $users_row["USER_ID"];?></td>
        <td><?php echo $users_row["FELHASZNALO_NEV"];?></td>
        <td><?php echo $users_row["USER_NEV"];?></td>
        <td><?php echo $users_row["JELSZO"];?></td>
        <td><?php echo $users_row["SZUL_DATUM"];?></td>
        <td><?php echo $users_row["NEM"];?></td>
        <td><?php echo $users_row["EMAIL"];?></td>
        <td><?php echo $users_row["VEGZETTSEG"];?></td>
        <td><?php echo $users_row["ERDEKLODES"];?></td>
        <td><?php echo $users_row["ADMIN"];?></td>
        <td><input type ="radio" value="<?php echo $users_row["USER_ID"];?>" name = "user_torol"></td>
    </tr>
<?php
    }
?>
</table>
<input type="submit" name="submit_user_torol" value="Felhasználó törlése"><br>
</form>

<h3> Kurzusok listája</h3>
<?php
if(isset($_POST['submit_kurzus_torol'])){
    $sql_del="DELETE FROM kurzusok WHERE KURZUS_ID = '$_POST[kurzus_torol]'";
    if(!mysqli_query($kapcsolat,$sql_del)){
        die(mysqli_error($kapcsolat));
    }
}
if(isset($_POST['submit_kurzus'])){
    $sql_insert="INSERT INTO kurzusok (KURZUS_NEV, KURZUS_LEIRAS) VALUES('$_POST[uj_kurzus_nev]','$_POST[uj_kurzus_leiras]')";
    if(!mysqli_query($kapcsolat,$sql_insert)){
        die(mysqli_error($kapcsolat));
    }
}
$kurzusok_query = mysqli_query($kapcsolat,"SELECT * FROM kurzusok");
?>
<form action="admin.php" method="post">
<table>
    <tr>
        <td>Azonosító</td>
        <td>Megnevezés</td>
        <td>Téma</td>
        <td>Leírás</td>
        <td>Kurzus törlése</td>
     </tr>
<?php
    while($kurzus_row = mysqli_fetch_assoc($kurzusok_query)){
?>
    <tr>
        <td><?php echo $kurzus_row["KURZUS_ID"];?></td>
        <td><?php echo $kurzus_row["KURZUS_NEV"];?></td>
        <td><?php echo $kurzus_row["KURZUS_ERDEKLODES"];?></td>
        <td><?php echo $kurzus_row["KURZUS_LEIRAS"];?></td>
        <td><input type ="radio" name = "kurzus_torol" value="<?php echo $kurzus_row["KURZUS_ID"];?>"></td>  
    </tr>
<?php
    }
?>
</table>
<input type="submit" name="submit_kurzus_torol" value="Kurzus törlése"><br>
</form>

<h3>Kurzus hozzáadása</h3>
<form action="admin.php" method="post">
Kurzus megnevezése: <input type="text" name="uj_kurzus_nev"><br>
Kurzus leírás: <input type="text" name="uj_kurzus_leiras"><br>
<input type="submit" name="submit_kurzus" value="Hozzáad"><br>
</form>

</body>
</html>