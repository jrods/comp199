<html>
<head>
  		<link rel="stylesheet" href="css/stylesheet.css" type="text/css" />
		<meta name="viewpoint" content="width=device-width, initial-scale=1.0">

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script>
			var modal = (function(){
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
						top:top + $(window).scrollTop(),
						left:left + $(window).scrollLeft()
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

				$(document).ready(function(){
					$('body').append($overlay, $modal);
				});

				$close.click(function(e){
					e.preventDefault();
					method.close();
				});

				return method;
			}());

			// Wait until the DOM has loaded before querying the document
			$(document).ready(function(){

                        $('a#register').click(function(e){

			        modal.open({content: "Username:<br> <input type='text' name='username' id='username' /><br><br> Email:<br> <input type='text' name='email' id='email' /><br><br> Password: <br><input type='password' name='password' id='password'/><br><br> Confirm password: <br><input type='password' name='confirmpwd' id='confirmpwd' /><br><br> <input type='button' value='Register' onclick='return regformhash(this.form, this.form.username, this.form.email, this.form.password, this.form.confirmpwd);' /> "});
			        e.preventDefault();
                        });
                  });
      </script>
</head>
<body>
<form action='scripts/php/process_login.php' method='post' name='login_form'>
        Email<br> <input type='text' name='email' /><br><br>
        Password<br> <input type='password' name='password' id='password'/>  
        <br><br> 
        <input type='button' value='Login' onclick='formhash(this.form, this.form.password);' /> 
        </form> 
        <p>If you don't have a login, please
        <a id="register" href="#">Register</a>
        <p>If you are done, please
        <a href='scripts/php/logout.php'>log out</a>.
        </p> <p>You are currently logged out.</p>
</body>
</html>