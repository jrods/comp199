<?php

include_once 'scripts/php/register.inc.php';
include_once 'scripts/php/functions.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Registration Form</title>
        <script type="text/JavaScript" src="js/sha512.js"></script>
        <script type="text/JavaScript" src="js/forms.js"></script>
    </head>
    <body>
    <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
        ?>

        <form method="post" name="registration_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
            Username:<br> <input type='text' name='username' id='username' /><br><br>
            Email:<br> <input type="text" name="email" id="email" /><br><br>
            Password:<br> <input type="password"
                             name="password"
                             id="password"/><br><br>
            Confirm password:<br> <input type="password"
                                     name="confirmpwd"
                                     id="confirmpwd" /><br><br>
        <?php

          require_once('recaptchalib.php');
          $publickey = "6LedAfMSAAAAACWML8zfyKCPmek4WqzPxAtGKFk6"; // you got this from the signup page
          echo recaptcha_get_html($publickey);
        ?>
        <input type="button"
                   value="Register" 
                   onclick="return regformhash(this.form,
                                   this.form.username,
                                   this.form.email,
                                   this.form.password,
                                   this.form.confirmpwd);" />
        </form>
        <p>Return to the <a href="index.php">login page</a>.</p>
    </body>
</html>
