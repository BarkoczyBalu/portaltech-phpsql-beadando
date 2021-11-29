<?php
header("Content-type: text/html; charset=utf-8");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
<title>Regisztráció</title>
</head>
<body>

<div class="container-md mt-4">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h1>ProPrograming Kurzusok</h1>
            <br>
            <h2>Regisztráció</h2>
            <hr class="text-primary">
            <div id="errors">
                <?php 
                    if (isset($_GET["errorMsg"])) {
                        echo '<div class="alert alert-danger p-2" role="alert">Kérlek ellenőrizd az adataidat, mert a regisztráció hibára futott!</div>';
                    }
                ?>
            </div>
            
            <form action="check-register.php" method="post" onSubmit="return isEmpty()">
                <table>
                    <tr class="border border-5 border-white">
                        <td class="text-end pe-1">Felhasználónév:</td>
                        <td><input type="text" class="form-control" name="username" id="username" required></td>
                    </tr>
                    <tr>
                        <td class="text-end pe-1">Jelszó:</td>
                        <td><input type="text" class="form-control" name="password" id="password" pattern=".{5,}" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-end"><em style="font-size: 12px;">A jelszónak min. 5 karakter hosszúnak kell lennie</em></td>
                    </tr>
                    <tr class="border border-5 border-white">
                        <td class="text-end pe-1">Név:</td>
                        <td><input type="text" class="form-control" name="name" id="name" required></td>
                    </tr>
                    <tr>
                        <td class="text-end pe-1">Születési dátum:</td>
                        <td><input type="date" class="form-control" name="birthDate" id="birthDate" required></td>
                    </tr>
                    <tr class="border border-5 border-white">
                        <td class="text-end pe-1">Nem:</td>
                        <td>
                            <input type="radio" class="form-check-input" name="gender" value="Nő" checked> Nő
                            <input type="radio" class="form-check-input" name="gender" value="Férfi"> Férfi
                        </td>
                    </tr>
                    <tr>
                        <td class="text-end pe-1">Email:</td>
                        <td><input type="email" class="form-control" name="email" id="email" required></td>
                    </tr>
                    <tr class="border border-5 border-white">
                        <td class="text-end pe-1">Végzettség:</td>
                        <td><input type="text" class="form-control" name="certificate" id="certificate"></td>
                    </tr>
                    <tr>
                        <!-- Hiba: A tömböt nem tudtam beolvasni HTML-ből másik PHP file-ba
                            Megoldás: HTML name attribútum mögé kapcsos zárójel -->
                        <td class="text-end pe-1">Érdeklődés:</td>
                        <td>
                            <input type="checkbox" class="form-check-input"  name="interests[]" value="Webdesign"> Webdesign <br>
                            <input type="checkbox" class="form-check-input"  name="interests[]" value="Főzés"> Főzés <br>
                            <input type="checkbox" class="form-check-input"  name="interests[]" value="IT tanulás"> IT tanulás <br>
                            <input type="checkbox" class="form-check-input"  name="interests[]" value="Kézműves tárgyak készítése"> Kézműves tárgyak készítése <br>
                            <input type="checkbox" class="form-check-input"  name="interests[]" value="Festészet"> Festészet 
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right;">
                            <input type="submit" class="btn btn-primary" name="submit" value="Regisztráció">
                        </td>
                    </tr>
            </form>
                    <tr>
                        <td colspan="2">
                            <button class="btn btn-primary p-1"><a href="login.php" style="text-decoration: none; color: white;">Vissza</a></button>
                        </td>
                    </tr>
                </table>
            </div>
        <div class="col-sm-3"></div>
    </div>
</div>

</body>
</html>