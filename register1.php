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
    <script>
        var modal = (function () {
            var
                method = {},
                $overlay,
                $modal,
                $content,
                $close;

            // Center the modal in the viewport
            method.center = function () {
                var top, left;

                top = Math.max($(window).height() - $modal.outerHeight(), 0) / 2;
                left = Math.max($(window).width() - $modal.outerWidth(), 0) / 2;

                $modal.css({
                    top: top + $(window).scrollTop(),
                    left: left + $(window).scrollLeft()
                });
            };

            // Open the modal
            method.open = function (settings) {
                $content.empty().append(settings.content);

                $modal.css({
                    width: settings.width || 'auto',
                    height: settings.height || 'auto'
                });

                method.center();
                $(window).bind('resize.modal', method.center);
                $modal.show();
                $overlay.show();
            };

            // Close the modal
            method.close = function () {
                $modal.hide();
                $overlay.hide();
                $content.empty();
                $(window).unbind('resize.modal');
            };

            // Generate the HTML and add it to the document
            $overlay = $('<div id="overlay"></div>');
            $modal = $('<div id="modal"></div>');
            $content = $('<div id="content"></div>');
            $close = $('<a id="close" href="#"></a>');

            $modal.hide();
            $overlay.hide();
            $modal.append($content, $close);

            $(document).ready(function () {
                $('body').append($overlay, $modal);
            });

            $close.click(function (e) {
                e.preventDefault();
                method.close();
            });

            return method;
        }());

        // Wait until the DOM has loaded before querying the document
        $(document).ready(function () {

            $('a.register').click(function (e) {
                $.get('register1.php', function (data) {
                    //$.get('ajax.php', function(data){
                    modal.open({content: data});
                    e.preventDefault();
                });
            });
            /*
             $('a#register').click(function(e){

             modal.open({content: "Username: <input type='text' name='username' id='username' /><br> Email: <input type='text' name='email' id='email' /><br> Password: <input type='password' name='password' id='password'/><br> Confirm password: <input type='password' name='confirmpwd' id='confirmpwd' /><br> <input type='button' value='Register' onclick='return regformhash(this.form, this.form.username, this.form.email, this.form.password, this.form.confirmpwd);' /> "});
             e.preventDefault();
             });   */
        });
    </script>

</head>
<body>

<?php
include_once 'scripts/php/functions.php';
include_once 'scripts/php/register.inc.php';
if (!empty($error_msg)) {
    echo $error_msg;
}
?>
<form method='post' name='registration_form' action='<?php echo esc_url($_SERVER['PHP_SELF']); ?>'>
    Username:<br> <input type='text' name='username' id='username'/><br>
    First Name:<br> <input type='text' name='firstname' id='firstname'/><br>
    Last Name:<br> <input type='text' name='lastname' id='lastname'/><br>
    Birthday:<br> <input type='text' name='bday' id='bday'/><br>
    Email:<br> <input type='text' name='email' id='email'/><br>
    Password:<br> <input type='password'
                         name='password'
                         id='password'/><br>
    Confirm password:<br> <input type='password'
                                 name='confirmpwd'
                                 id='confirmpwd'/><br>
    <input type='button'
           value='Register'
           onclick='return regformhash(this.form,
                                   this.form.username,
                                   this.form.bday,
                                   this.form.firstname,
                                   this.form.lastname,
                                   this.form.email,
                                   this.form.password,
                                   this.form.confirmpwd);'/>
</form>
<p>Return to the <a id="whiteText" href="index.php">login page</a>.</p>
</body>
</html>