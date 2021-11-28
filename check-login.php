<?php ob_start(); ?> 
<?php
header("Content-type: text/html; charset=utf-8");
if (isset($_POST["submit"])) {
    require_once("connect.php");
    mysqli_set_charset($kapcsolat, "utf-8");
    $username = mysqli_real_escape_string($kapcsolat, $_POST['username']);
    $password = sha1(mysqli_real_escape_string($kapcsolat, $_POST['password']));
    // $password = mysqli_real_escape_string($kapcsolat, $_POST['password']);
    $query_user = mysqli_query($kapcsolat, "SELECT * FROM users WHERE FELHASZNALO_NEV='$username' AND JELSZO='$password' AND ADMIN='0'");
    $query_admin = mysqli_query($kapcsolat, "SELECT * FROM users WHERE FELHASZNALO_NEV='$username' AND JELSZO='$password' AND ADMIN='1'");
    $existingUser = mysqli_query($kapcsolat, "SELECT * FROM users WHERE FELHASZNALO_NEV='$username'");
     

    if (mysqli_num_rows($query_user) === 1) {
        session_start();
        
        $_SESSION['username'] = $username;
        $_SESSION['loggedIn'] = true;
        
        if (isset($_POST['rememberUsername'])) {
            setcookie ("usernameCookie", $username ,time()+604800, "/" );
        } else {
            setcookie ("usernameCookie", "" ,time()-1, "/" );
        }

        header("Location: user.php");
    } else if(mysqli_num_rows($query_admin) === 1) {
        session_start();
        
        $_SESSION['username'] = $username;
        $_SESSION['loggedIn'] = true;
        
        if (isset($_POST['rememberUsername'])) {
            setcookie ("usernameCookie", $username ,time()+604800, "/" );
        } else {
            setcookie ("usernameCookie", "" ,time()-1, "/" );
        }

        header("Location: admin.php");
    } else if(mysqli_num_rows($existingUser) === 0) {
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
