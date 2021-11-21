<?php
header("Content-type: text/html; charset=utf-8");
if (isset($_POST["submit"])) {
    require_once("connect.php");
    $username = mysqli_real_escape_string($kapcsolat, $_POST['username']);
    $password = sha1(mysqli_real_escape_string($kapcsolat, $_POST['password']));
    $query = mysqli_query($kapcsolat, "SELECT * FROM users WHERE FELHASZNALO_NEV='$username' AND JELSZO='$password'");
    $existingUser = mysqli_query($kapcsolat, "SELECT * FROM users WHERE FELHASZNALO_NEV='$username'");
     

    if (mysqli_num_rows($query) === 1) {
        session_start();
        
        $_SESSION['username'] = $username;
        $_SESSION['loggedIn'] = true;
        
        if (isset($_POST['rememberUsername'])) {
            setcookie ("usernameCookie", $username ,time()+604800, "/" );
        } else {
            setcookie ("usernameCookie", "" ,time()-1, "/" );
        }

        header("Location: members.php");
    } else if($existingUser === 0) {
        header("Location: login.php?noUserFound=true");
        exit;
    } else {
        header("Location: login.php?nomatch=true");
        exit;
    }

} else {
    header("Location: login.php");
    exit;
}
?>
