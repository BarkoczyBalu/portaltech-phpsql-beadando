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

    $user_query = mysqli_query($kapcsolat,"SELECT USER_ID from users where FELHASZNALO_NEV = '$_SESSION[username]'");
    $user_id = mysqli_fetch_assoc($user_query)['USER_ID'];
?>

<a href="logout.php">Kijelentkezés</a>
<div id ="errors"></div>


<?php
    $felvett_query = mysqli_query($kapcsolat,
        "SELECT k.KURZUS_ID, k.KURZUS_NEV, k.KURZUS_LEIRAS 
        FROM kurzusok k join kurzus_log l on k.KURZUS_ID = l.KURZUS_ID
        where l.USER_ID = '$user_id'");
    
    if($felvett_query != FALSE){
        ?>
        <h3>Felvett kurzusok listája</h3>
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
                <td><?php echo $felvett_row["KURZUS_ID"];?></td>
                <td><?php echo $felvett_row["KURZUS_NEV"];?></td>
                <td><?php echo $felvett_row["KURZUS_LEIRAS"];?></td>
            </tr>
        </table>
<?php
    }
}
?>

<h3>Elérhető kurzusok listája</h3>
<?php
    $kurzusok_query = mysqli_query($kapcsolat,"SELECT * FROM kurzusok");
?>
<form action = "user.php" method = "post">
<table>
    <tr>
        <td>Felvesz</td>
        <td>Azonosító</td>
        <td>Megnevezés</td>
        <td>Téma</td>
        <td>Leírás</td>
    </tr>
<?php
    while($kurzus_row = mysqli_fetch_assoc($kurzusok_query)){
?>
    <tr>
        <td><input type ="radio" value="<?php echo $kurzus_row["KURZUS_ID"];?>" name = "felvesz_kurzus"></td>
        <td><?php echo $kurzus_row["KURZUS_ID"];?></td>
        <td><?php echo $kurzus_row["KURZUS_NEV"];?></td>
        <td><?php echo $kurzus_row["KURZUS_ERDEKLODES"];?></td>
        <td><?php echo $kurzus_row["KURZUS_LEIRAS"];?></td>
    </tr>
<?php
    };
?>
</table>
<input type="submit" name="submit" value="Hozzáad"><br>
</form>


<?php
if(isset($_POST['submit'])){
    $date = date("Y-m-d");

    $sql="INSERT INTO kurzus_log(KURZUS_ID, USER_ID, LOG_DATUM) VALUES('$_POST[felvesz_kurzus]', '$user_id', '$date')";
    if(!mysqli_query($kapcsolat,$sql)){
        die(mysqli_error($kapcsolat));
    }
}

?>
</body>
</html>