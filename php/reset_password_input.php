<html>
    <head>
        <title>Ifjúsági Könyvesbolt</title>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">

                    <h2>Elfelejtetted a jelszavad?</h2>   

                    <?php
					include 'config.php';
                    if (isset($_POST["email"]) && (!empty($_POST["email"]))) {
                        $email = $_POST["email"];
                        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
                        if (!$email) {
                            $error = "Hibás email";
                        } else {
                            $results = mysqli_query($db, "SELECT * FROM `users` WHERE email='" . $email . "'");
                            $row = mysqli_num_rows($results);
                            if ($row == "") {
                                $error = "Nincs ilyen regisztrált email cím";
                            }
                        }
                        if (!empty($error))
							{
                            echo $error;
                        } else {

                            
                            $expFormat = mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y"));
                            $expDate = date("Y-m-d H:i:s", $expFormat);
                            $key = md5(time());
                            $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
                            $key = $key . $addKey;
                            mysqli_query($db, "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`) 
							VALUES ('" . $email . "', '" . $key . "', '" . $expDate . "');");


                          mail($email,
							'Reset_password','link:
							<p><a href="http://localhost/szakdoga/reset_password.php?key=' . $key . '&email=' . $email . '&action=reset" target="_blank">
							http://localhost/szakdoga/reset_password.php?key=' . $key . '&email=' . $email . '&action=reset</a></p>',
							'From: ifjusagikonyvesbolt@gmail.com');
                        }
                    }
                    ?>
                    <form method="post" action="" name="reset">
                        

                        <div class="form-group">
                           <label><strong>Írd be az email címed:</strong></label>
                            <input type="email" name="email" placeholder="példa@email.com" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <input type="submit" id="reset" value="küldés"  class="btn btn-primary"/>
                        </div>
                    </form>

                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </body>
</html>