<?php ob_start(); ?>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php
header("Content-type: text/html; charset=utf-8");
if (isset($_POST["submit"])) {
    require_once("connect.php");
    $username = mysqli_real_escape_string($kapcsolat, $_POST['username']);
    $password = sha1(mysqli_real_escape_string($kapcsolat, $_POST['password']));
    $name = $_POST['name'];
    $date = $_POST['birthDate'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $certificate = $_POST['certificate'];
    $interestsString = "";
    foreach( $_POST['interests'] as  $interest){
        $interestsString = $interestsString.$interest."; ";
    }

    $existingUser = mysqli_query($kapcsolat, "SELECT * FROM users WHERE FELHASZNALO_NEV='$username'");
     

    if (mysqli_num_rows($existingUser) === 0) {
        
        /* Hiba: UTF-8 kódolást nem ismerte fel
            Megoldás:  $kapcsolat->set_charset("utf8");-el működik */ 
        $kapcsolat->set_charset("utf8");
        mysqli_set_charset($kapcsolat, "utf-8");
        mysqli_query($kapcsolat,"INSERT INTO users (FELHASZNALO_NEV, JELSZO, USER_NEV, SZUL_DATUM, NEM, EMAIL, VEGZETTSEG, ERDEKLODES, ADMIN) VALUES('".$username."','".$password."','".$name."','".$date."','".$gender."','".$email."','".$certificate."','".$interestsString."','0')");
        
        header("Location: login.php");
    }

} else {
    header("Location: register.php?errorMsg='true'");
    exit;
}
?>