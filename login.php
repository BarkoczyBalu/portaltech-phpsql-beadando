<?php
header("Content-type: text/html; charset=utf-8");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
</head>
<body>

<div>
    <h1>ProPrograming Kurzusok</h1>
    <h2>Bejelentkezés</h2>
    <div id="errors">
        <?php 
            // setcookie ("usernameCookie", "Lajos" ,time()+604800, "/" );
            if (isset($_GET["nomatch"] || isset($_GET["noUserFound"])) {
                if($_GET["nomatch"] === "true") {
                    echo '<h3 style="color: red;">Hibás felhasználónév/jelszó páros</h3>';
                } else if($_GET["noUserFound"] === "true") {
                    echo '<h3 style="color: red;">Nem létezik ilyen nevű felhasználó az adatbázisban.</h3>';
                }
            }
        ?>
    </div>
    <form action="check.php" method="post" onSubmit="return isEmpty()">
        <table>
            <tr>
                <td>Felhasználónév:</td>
                <td><input type="text" name="username" id="username" value="<?php if(isset($_COOKIE["usernameCookie"])) {print($_COOKIE['usernameCookie']);}?>"></td>
            </tr>
            <tr>
                <td>Jelszó:</td>
                <td><input type="password" name="password" id="password"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="checkbox" name="rememberUsername" checked> Felhasználónév megjegyzése
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;">
                    <input type="submit" name="submit" value="Login">
                </td>
            </tr>
        </table>
    </form>
</div>

<script>
    function isEmpty() {
        let emptyUsername = '<h3 style="color: red;">Töltsd ki a "Felhasználónév" mezőt a belépéshez!</h3>';
        let emptyPassword = '<h3 style="color: red;">Töltsd ki a "Jelszó" mezőt a belépéshez!</h3>';
        let emptyUserAndPassword = '<h3 style="color: red;">Töltsd ki mind két mezőt a belépéshez!</h3>';
        
        if (document.getElementById("username").value === "" && document.getElementById("password").value === "") {
            document.getElementById("errors").innerHTML = emptyUserAndPassword;
            return false;
        } else if (document.getElementById("username").value === "") {
            document.getElementById("errors").innerHTML = emptyUsername;
            return false;
        } else if (document.getElementById("password").value === "") {
            document.getElementById("errors").innerHTML = emptyPassword;
            return false;
        } else {
            return true;
        }
    }
</script>

</body>
</html>