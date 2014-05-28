<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tune Source</title>
    <meta charset = "utf-8" />
		
    <link href="css/index-style.css" rel="stylesheet" type="text/css" />
    <meta name="viewpoint" content="width=device-width, initial-scale=1.0">

    <!-- Gallery Generator -->
    <link href="css/buttons.css" rel="stylesheet" type="text/css" />
    <link href="css/galleryGenerator.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'/>
    
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

 			  $('a#login').click(function(e){

                            $.get('ajax.php', function(data){
					modal.open({content: data});
                                        e.preventDefault();
				});
			  });
                     });

</script>

</head>
<header class="header fixed bar" role="banner">
    <nav>
        <ul class="bar" id="list">
            <li id="navContent">
                <div class="item">
                    <div class="logoBlock"><span class="temp" id="whiteText">Tune Source</span></div>
                </div>

                <div class="item">
                    <div class="searchBlock">
                        <input type="search" placeholder="search" id="searchBar" />
                        <div id="searchButton">
                            <button value="searchButton"><img id="searchImage" src="res/image/search.png"></img></button>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="cartBlock"><a href="#cartMukery" id="whiteText" class="cartBox" title="<?php require_once "viewCart.php"; ?>Cart</a></div>
                </div>

                <div class="item">
                    <div class="loginBlock">
                        <input type="text" id="userInput" name="username" placeholder="username"/>
                        <input type="password" id="passInput" name="password" placeholder="password"/>
                        <input type="submit" value="Login" />
                    </div>
                </div>
            </li>
        </ul>
    </nav>
</header>
<body>
    <div class="contentBody">

 <form name   = "menduorder" method = "post"
       id     = "formbox"
       action = "script/processform.php">
       
  <fieldset>      
   <legend>Register</legend>
     <div class= "row">
     <span class= "form_element">
      
   <input type= "text" 
          name= "firstname"
          required id= "firstname"
          placeholder= "Your First Name" >
          </span>
        </div>
            
     <div class= "row">
     <span class= "form_element"> 
   <input type= "text" 
          name= "lastname"
          required id= "lastname"
          placeholder= "Your Last Name" >
          </span>
        </div>
	<div class= "row">
    <span class= "form_element">	
    <input type= "text" 
          name= "Country"
          required id= "Country"
          placeholder= "Enter Your Country" >
          </span>
        </div>
	
	<div class= "row">
    <span class= "form_element">
	<input type= "text" 
          name= "Province/State"
          required id= "province/state"
          placeholder= "Province Or State" >
          </span>
        </div>
	
	<div class= "row">
    <span class= "form_element">	
	<input type= "text" 
          name= "Address"
          required id= "Address"
          placeholder= "Enter Your Address" >
          </span>
        </div>
	
	<div class= "row">
    <span class= "form_element">	
	<input type= "text" 
          name= "Postal Code/Zip"
          required id= "postalcode/zip"
          placeholder= "Postal Code Or Zip" >
          </span>
        </div>
            
        <div class= "row">
     <span class= "form_element">    
   <input 
          title= "Expected format as 250-999-9999"
          type= "tel" 
          name= "phone"
          required id= "phone"
          placeholder= "250-999-9999"
          pattern="[\(]\d{3}[\)]\d{3}[\-]\d{4}">
          </span>
        </div> 
            
     <div class= "row">
     <span class= "form_element"> 
   <input type= "text" 
          name= "credit"
          required id= "credit"
          placeholder= "Credit Card number"
          pattern="[0-0]{4,6}">
          </span>  
        </div>        
 
     <div class= "row">
     <span class= "form_element">        
   <input type= "text" 
          name= "expiry"
          required id= "expiry"
          placeholder= "Credit card expiry"
          pattern= "\d{2}-\d{2}"
          title= "Credit card expiry as MM-YY">
          </span>
        </div>
		
		<button type="button">Register</button>


        </div>

    </div>

<!-- Load jQuery, SimpleModal and Basic JS files -->
<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/basic.js'></script>


<script>

var itemCounter = <?php echo json_encode("removeFromCartButton$itemCounter") ?>;

 			  $('button[type=button]').click(function(e){
                            var test3 = $(this).attr("name");
                            //var test4 = $('button[name=<?php echo json_encode("$newThing[0]") ?>]').val()
                            var test5 = $('button[name='+test3+']').val();
                            $.post('removeFromCart.php', {test3:test5}, function(data){
					modal.open({content: data});
                                        e.preventDefault();
				});
			  });
			  
			  $('button[type=submit]').click(function(e){
                            //var test4 = $('button[name=<?php echo json_encode("$newThing[0]") ?>]').val()
                            $.post('addToCart.php', function(data){
					modal.open({content: data});
                                        e.preventDefault();
				});
			  });

</script>
</body>

<footer class="footer fixed bar">
    <div>
        <span id="whiteText">Copyright &copy; 2014</span><br />
        <span id="whiteText">Authors: Sam Beveridge, Calvin Lam, Jared Smith</span>
    </div>
</footer>
</html>