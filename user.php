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
</head>
<body>

<?php

    echo "Hello ".$_SESSION['username']."!<br>";

    require_once("connect.php");
    $kapcsolat->set_charset("utf8");

    $user_query = mysqli_query($kapcsolat,"SELECT USER_ID from users where FELHASZNALO_NEV = '$_SESSION[username]'");
    $user_id = mysqli_fetch_assoc($user_query)['USER_ID'];
?>

<a href="logout.php">Kijelentkezés</a>

<?php
    if(isset($_POST['submit_felvesz'])){
        $date = date("Y-m-d");
        $felvettKurzus = mysqli_query($kapcsolat, "SELECT * FROM kurzus_log WHERE USER_ID = '$user_id' AND KURZUS_ID = '$_POST[felvesz_kurzus]'");
        
        if (mysqli_num_rows($felvettKurzus) === 0) {
            $sql_felvesz="INSERT INTO kurzus_log(KURZUS_ID, USER_ID, LOG_DATUM) VALUES('$_POST[felvesz_kurzus]', '$user_id', '$date')";
            if(!mysqli_query($kapcsolat,$sql_felvesz)){
                die(mysqli_error($kapcsolat));
            }
        }
        else{
            echo '<h3 style="color: red;">Ezt a kurzust már felvetted!</h3>';
        }
    }
    if(isset($_POST['submit_lead'])){
        $sql_lead="DELETE FROM kurzus_log WHERE KURZUS_ID = '$_POST[lead_kurzus]' AND USER_ID = '$user_id'";
        if(!mysqli_query($kapcsolat,$sql_lead)){
            die(mysqli_error($kapcsolat));
        }
    }   
?>
    <h3>Felvett kurzusok listája</h3>
    <form action = "user.php" method = "post">
    <table>
         <tr>
            <td>Lead</td>
            <td>Azonosító</td>
            <td>Megnevezés</td>
            <td>Leírás</td>
        </tr>
    <?php 
        $felvett_query = mysqli_query($kapcsolat,
            "SELECT k.KURZUS_ID, k.KURZUS_NEV, k.KURZUS_LEIRAS 
            FROM kurzusok k join kurzus_log l on k.KURZUS_ID = l.KURZUS_ID
            where l.USER_ID = '$user_id'");  
          
        while($felvett_row = mysqli_fetch_assoc($felvett_query)){
    ?>
        <tr>
           <td><input type ="radio" name = "lead_kurzus" value="<?php echo $felvett_row["KURZUS_ID"];?>"></td>
           <td><?php echo $felvett_row["KURZUS_ID"];?></td>
           <td><?php echo $felvett_row["KURZUS_NEV"];?></td>
           <td><?php echo $felvett_row["KURZUS_LEIRAS"];?></td>
        </tr>
    <?php
        }
    ?>
    </table>
    <input type="submit" name="submit_lead" value="Lead"><br>
    </form>


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
        <td><input type ="radio" name = "felvesz_kurzus" value="<?php echo $kurzus_row["KURZUS_ID"];?>"></td>
        <td><?php echo $kurzus_row["KURZUS_ID"];?></td>
        <td><?php echo $kurzus_row["KURZUS_NEV"];?></td>
        <td><?php echo $kurzus_row["KURZUS_ERDEKLODES"];?></td>
        <td><?php echo $kurzus_row["KURZUS_LEIRAS"];?></td>
    </tr>
<?php
    };
?>
</table>
<input type="submit" name="submit_felvesz" value="Felvesz"><br>
</form>

</body>
</html>