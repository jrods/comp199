<?php

include_once 'scripts/php/register.inc.php';
include_once 'scripts/php/functions.php';

?>
<html>
<head>
    <link rel="stylesheet" href="css/index-style.css" type="text/css"/>
    <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
    <script type="text/JavaScript" src="js/sha512.js"></script>
    <script type="text/JavaScript" src="js/forms.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

</head>
<body>

<?php

if (!empty($error_msg)) {
    echo $error_msg;
}
?>

<div class="registerInfo" >
    <h2>Registration Form</h2>
</div>

<div class="registerBlock">
<form method='post' name='registration_form' action='<?php echo esc_url($_SERVER['PHP_SELF']); ?>'>
    <div id="username" class="label">Username:</div>
    <input type='text' name='username' id='username'/>

    <div id="firstname" class="label">First Name:</div>
    <input type='text' name='firstname' id='firstname'/>

    <div id="lastname" class="label">Last Name:</div>
    <input type='text' name='lastname' id='lastname'/>

    <div id="birthday" class="label">Birthday:</div>
    <input type='text' name='bday' id='bday' placeholder="yyyy-mm-dd"/>

    <div id="email" class="label">Email:</div>
    <input type='text' name='email' id='email'/>

    <div id="password" class="label">Password:</div>
    <input type='password' name='password' id='password'/>

    <div id="password" class="label">Confirm password:</div>
    <input type='password' name='confirmpwd' id='confirmpwd'/>

    <div id="submitButton"class="button">
    <input type='button' value='Register' id="whiteText" class="loginButton" onclick='return regformhash(this.form, this.form.username, this.form.bday,
                                                                      this.form.firstname, this.form.lastname, this.form.email,
                                                                      this.form.password, this.form.confirmpwd);'/>
    </div>

</form>

</div>

</body>
</html>