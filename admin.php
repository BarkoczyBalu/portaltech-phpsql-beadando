<?php
ob_start();
session_start();
header("Content-type: text/html; charset=utf-8");

if(!$_SESSION['loggedIn']){
    header("Location:login.php");
    exit;
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin oldal</title>
    <style>
        #errors{color:red;}
    </style>
</head>
<body>

<?php
echo "Üdv ".$_SESSION['username']."!<br>";
require_once("connect.php");
?>
<a href="logout.php">Kijelentkezés</a>

<h3> Felhasználók listája</h3>
<?php
$users_query = mysqli_query($kapcsolat,"SELECT * FROM users");
?>
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
     </tr>
<?php
    while($users_row = mysqli_fetch_assoc($users_query)){
    ?>
    <tr>
        <td><?php echo $row["user_id"];?></td>
        <td><?php echo $row["felhasznalo_nev"];?></td>
        <td><?php echo $row["user_nev"];?></td>
        <td><?php echo $row["jelszo"];?></td>
        <td><?php echo $row["szul_datum"];?></td>
        <td><?php echo $row["nem"];?></td>
        <td><?php echo $row["email"];?></td>
        <td><?php echo $row["vegzettseg"];?></td>
        <td><?php echo $row["erdeklodes"];?></td>
    </tr>
    <?php
    }
    ?>
    </table>

    <form action="admin.php" method="post">
        <select name = "user_torol">
            <?php
            while($kurzus_row = mysqli_fetch_assoc($kurzusok_query)){
                echo '<option value="'.$users_row["user_id"].'">'.$users_row["felhasznalo_nev"].'</option>';
            }
            ?>
        </select>
        <input type="submit" name="user_torol_submit" value="Töröl"><br>
    </form>

<?php
if(isset($_POST['user_torol_submit'])){
    
    $sql="DELETE FROM users WHERE user_id = '$_POST[user_torol]'";

        if(!mysqli_query($kapcsolat,$sql)){
            die(mysqli_error($kapcsolat));
        }
    }
?>

<h3> Kurzusok listája</h3>
<?php
$kurzusok_query = mysqli_query($kapcsolat,"SELECT * FROM kurzusok");
?>
<table>
    <tr>
        <td>Azonosító</td>
        <td>Megnevezés</td>
        <td>Téma</td>
        <td>Leírás</td>
     </tr>
<?php
    while($users_row = mysqli_fetch_assoc($users_query)){
    ?>
    <tr>
        <td><?php echo $row["kurzus_id"];?></td>
        <td><?php echo $row["kurzus_nev"];?></td>
        <td><?php echo $row["kurzus_erdeklodes"];?></td>
        <td><?php echo $row["kurzus_leiras"];?></td>
    </tr>
    <?php
    }
    ?>
    </table>

    <form action="admin.php" method="post">
        <select name = "kurzus_torol">
            <?php
            while($kurzus_row = mysqli_fetch_assoc($kurzusok_query)){
                echo '<option value="'.$kurzusok_row["kurzus_id"].'">'.$kurzusok_row["kurzus_id"].'-'$kurzusok_row["kurzus_nev"].'</option>';
            }
            ?>
        </select>
        <input type="submit" name="kurzus_torol_submit" value="Töröl"><br>
    </form>

    <form action="admin.php" method="post">
        Kurzus megnevezése: <input type="text" name="uj_kurzus_nev"><br>
        Kurzus leírás: <input type="text" name="uj_kurzus_leiras"><br>
        <input type="submit" name="kurzus_submit" value="Hozzáad"><br>

    </form>

<?php
if(isset($_POST['kurzus_torol_submit'])){
    
    $sql="DELETE FROM kurzusok WHERE kurzus_id = '$_POST[kurzus_torol]'";

        if(!mysqli_query($kapcsolat,$sql)){
            die(mysqli_error($kapcsolat));
        }
    }
}

if(isset($_POST['kurzus_submit'])){
    $sql="INSERT INTO kurzusok (kurzus_nev, kurzus_leiras) VALUES('$_POST[uj_kurzus_nev]','$_POST[uj_kurzus_leiras]')";

    if(!mysqli_query($kapcsolat,$sql)){
        die(mysqli_error($kapcsolat));
    }
}
?>






</body>
</html>