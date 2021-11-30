<?php
header("Content-type: text/html; charset=utf-8");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
<title>Belépés</title>
</head>
<body>

<div class="container-md mt-4">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h1>ProPrograming Kurzusok</h1>
            <br>
            <h2>Bejelentkezés</h2>
            <hr class="text-primary">
            <div id="errors" class="mx-2">
                <?php 
                    if (isset($_GET["nomatch"]) || isset($_GET["noUserFound"]) || isset($_GET["regSuccess"])) {
                        if($_GET["nomatch"] === "true") {
                            echo '<div class="alert alert-danger p-2" role="alert">Hibás felhasználónév/jelszó páros</div>';
                        } else if($_GET["noUserFound"] === "true") {
                            echo '<div class="alert alert-danger p-2" role="alert">Nem létezik ilyen nevű felhasználó az adatbázisban.</div>';
                        } else if ($_GET["regSuccess"] === "true") {
                            echo '<div class="alert alert-success p-2" role="alert">Sikeres regisztráció!</div>';
                        }
                    }
                ?>
            </div>
            <form action="check-login.php" method="post" onSubmit="return isEmpty()">
                <table class="my-3">
                    <tr>
                        <td class="text-end pe-1">Felhasználónév:</td>
                        <td><input type="text" class="form-control" name="username" id="username" value="<?php if(isset($_COOKIE["usernameCookie"])) {print($_COOKIE['usernameCookie']);}?>"></td>
                    </tr>
                    <tr class="border border-5 border-white">
                        <td class="text-end pe-1">Jelszó:</td>
                        <td><input type="password" class="form-control" name="password" id="password"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="checkbox" class="form-check-input" name="rememberUsername" checked> Felhasználónév megjegyzése
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right;">
                            <input type="submit" class="btn btn-primary" name="submit" value="Belépés">
                        </td>
                    </tr>
            </form>
                    <tr>
                        <td colspan="2">
                            <p class="my-2">Nincs még fiókod? Regisztrálj most!</p>
                            <button class="btn btn-primary" name="register"><a href="register.php" style="text-decoration: none; color: white;">Regisztráció</a></button>
                        </td>
                    </tr>
                </table>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>

<script>
    function isEmpty() {
        let emptyUsername = '<div class="alert alert-danger p-2" role="alert">Töltsd ki a "Felhasználónév" mezőt a belépéshez!</div>';
        let emptyPassword = '<div class="alert alert-danger p-2" role="alert">Töltsd ki a "Jelszó" mezőt a belépéshez!</div>';
        let emptyUserAndPassword = '<div class="alert alert-danger p-2" role="alert">Töltsd ki mind két mezőt a belépéshez!</div>';
        
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