<html lang="hu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Ifjúsági Könyvesbolt </title>
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="_css/regisztracio2.css">
<style>
</style>
</head>
    <body>
    <div class="row">
    <div id="hasab1">
                    <?php
                    include 'config.php';
                    if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) && ($_GET["action"] == "reset") && !isset($_POST["action"])) {
                        $key = $_GET["key"];
                        $email = $_GET["email"];
                        $curDate = date("Y-m-d H:i:s");
                        $query = mysqli_query($db, "SELECT * FROM `password_reset_temp` WHERE `key`='" . $key . "' and `email`='" . $email . "';")
						or die_nicely("Hiba!<br>próbáld újra.");
                        $row = mysqli_num_rows($query);
                        if ($row == "") {
                            $error = '<h2>Hibás link</h2>';
                        } else {
                            $row = mysqli_fetch_assoc($query);
                            $expDate = $row['expDate'];
                            if ($expDate >= $curDate) {
                    ?> 
    <h2>Változtasd meg a jelszavad</h2>   
        <form method="post" action="" name="update">
        <input type="hidden" name="action" value="update"><br>
        <label><strong>Új jelszó:</strong></label><br>
        <input type="password"  name="pass1" value="update"><br>
		<label><strong>Új jelszó újra:</strong></label><br>
        <input type="password"  name="pass2" value="update">
		<input type="hidden" name="email" value="<?php echo $email; ?>"><br><br>
		<input type="submit" id="reset" value="Jelszó változtatás">
		</form>
                    <?php
                            } else {
                                $error = "<h2>Lejárt link</h2>";
                            }
                        }
                        if (!empty($error)) {
                            echo "<div class='error'>" . $error . "</div><br>";
                        }
                    }
                    if (isset($_POST["email"]) && isset($_POST["action"]) && ($_POST["action"] == "update")) {
                        $error = "";
                        $pass1 = mysqli_real_escape_string($db, $_POST["pass1"]);
                        $pass2 = mysqli_real_escape_string($db, $_POST["pass2"]);
                        $email = $_POST["email"];
                        $curDate = date("Y-m-d H:i:s");
                        if ($pass1 != $pass2) {
                            $error = "<p>A Jelszavak nem egyeznek.<br><br></p>";
                        }
                        if (!empty($error)) {
                            echo $error;
                        } else {

                            $pass1 = md5(md5($pass1));
                            mysqli_query($db, "UPDATE `users` SET `pass1` = '" . $pass1 . "' WHERE `email` = '" . $email . "'")
							or die_nicely("Hiba!<br>próbáld újra.");

                            mysqli_query($db, "DELETE FROM `password_reset_temp` WHERE `email` = '$email'")
							or die_nicely("Hiba!<br>próbáld újra.");

                            echo '<div class="error"><p>A jelszavad sikeresen megváltoztattad.</p></div>';
                        }
                    }
                    ?>  
    </div>
    </div>
    </body>
</html>