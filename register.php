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
    <h2>Regisztráció</h2>
    <div id="errors">
        <?php 
            if (isset($_GET["errorMsg"])) {
                echo '<h3 style="color: red;">Kérlek ellenőrizd az adataidat, mert a regisztráció hibára futott!</h3>';
            }
        ?>
    </div>
    
    <form action="check-register.php" method="post" onSubmit="return isEmpty()">
        <table>
            <tr>
                <td>Felhasználónév:</td>
                <td><input type="text" name="username" id="username" required></td>
            </tr>
            <tr>
                <td>Jelszó:</td>
                <td><input type="text" name="password" id="password" pattern=".{5,}" required></td>
            </tr>
            <tr>
                <td colspan="2"><em style="font-size: 12px;">A jelszónak min. 5 karakter hosszúnak kell lennie</em></td>
            </tr>
            <tr>
                <td>Név:</td>
                <td><input type="text" name="name" id="name" required></td>
            </tr>
            <tr>
                <td>Születési dátum:</td>
                <td><input type="date" name="birthDate" id="birthDate" required></td>
            </tr>
            <tr>
                <td>Nem:</td>
                <td>
                    <input type="radio" name="gender" value="Nő" checked> Nő
                    <input type="radio" name="gender" value="Férfi"> Férfi
                </td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" id="email" required></td>
            </tr>
            <tr>
                <td>Végzettség:</td>
                <td><input type="text" name="certificate" id="certificate"></td>
            </tr>
            <tr>
                <!-- Hiba: A tömböt nem tudtam beolvasni HTML-ből másik PHP file-ba
                    Megoldás: HTML name attribútum mögé kapcsos zárójel -->
                <td>Érdeklődés:</td>
                <td>
                    <input type="checkbox" name="interests[]" value="Webdesign" id=""> Webdesign <br>
                    <input type="checkbox" name="interests[]" value="Főzés" id=""> Főzés <br>
                    <input type="checkbox" name="interests[]" value="IT tanulás" id=""> IT tanulás <br>
                    <input type="checkbox" name="interests[]" value="Kézműves tárgyak készítése" id=""> Kézműves tárgyak készítése <br>
                    <input type="checkbox" name="interests[]" value="Festészet" id=""> Festészet 
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;">
                    <input type="submit" name="submit" value="Regisztráció">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button><a href="login.php" style="text-decoration: none; color: black;">Vissza</a></button>
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>