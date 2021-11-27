<?php
ob_start();
session_start();
header("Content-type: text/html; charset=utf-8");

if(!$_SESSION['loggedIn'])
{
    header("Location:login.php");
    exit;
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Hallgatói oldal</title>
    <style>
        #errors{color:red;}
    </style>
</head>
<body>

<?php
    echo "Hello ".$_SESSION['username']."!<br>";

    require_once("connect.php");

    $user_query = mysqli_query($kapcsolat,"SELECT * from users where felhasznalo_nev = $_SESSION['username']")
    $user_id = mysqli_fetch_assoc($user_query)["user_id"]
?>

<a href="logout.php">Kijelentkezés</a>
<div id ="errors"></div>

<h3>Felvett kurzusok listája</h3>
<?php
    $felvett_query = mysqli_query($kapcsolat,"SELECT k.kurzus_id, k.kurzus_nev, k.kurzus_leiras 
                                        FROM kurzusok k
                                        join kurzus_log l on k.kurzus_id = l.kurzus_id
                                        where l.user_id = $user_id
                                        ");
?>
<table>
    <tr>
        <td>Azonosító</td>
        <td>Megnevezés</td>
        <td>Leírás</td>
    </tr>
<?php
    while($felvett_row = mysqli_fetch_assoc($felvett_query)){
?>
    <tr>
        <td><?php echo $felvett_row["k.kurzus_id"];?></td>
        <td><?php echo $felvett_row["k.kurzus_nev"];?></td>
        <td><?php echo $felvett_row["k.kurzus_leiras"];?></td>
    </tr>
</table>
<?php
    }
?>

<h3>Elérhető kurzusok listája</h3>
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
    while($kurzus_row = mysqli_fetch_assoc($kurzusok_query)){
?>
    <tr>
        <td><?php echo $kurzus_row["kurzus_id"];?></td>
        <td><?php echo $kurzus_row["kurzus_nev"];?></td>
        <td><?php echo $kurzus_row["kurzus_erdeklodes"];?></td>
        <td><?php echo $kurzus_row["kurzus_leiras"];?></td>
    </tr>
<?php
    }
?>
</table>

<h3>Kurzusfelvétel</h3>
<form action = "user.php" method = "post">
    <select name = "felvetel">
        <?php
        while($kurzus_row = mysqli_fetch_assoc($kurzusok_query)){
            echo '<option value="'.$kurzus_row["kurzus_id"].'">'.$kurzus_row["kurzus_nev"].'</option>';
        }
        ?>
    </select>
    <input type="submit" name="submit" value="Hozzáad"><br>
</form>

<?php
if(isset($_POST['submit'])){
    
    $sql="INSERT INTO kurzus_log(kurzus_id, user_id) VALUES('$_POST[felvetel]',$user_id)";

        if(!mysqli_query($kapcsolat,$sql)){
            die(mysqli_error($kapcsolat));
        }
    }

?>
</body>
</html>