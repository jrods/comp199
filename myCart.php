<html>
<head>
    <?php
    
    if(! isset($_SESSION['cart'])) {
        $_SESSION['cart'] = 0;
    }
    
    ?>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/imagesloaded.pkg.min.js"></script>

    <script>
        function formhash(form, fname, lname, country, province, address, postal, phone, credit, expiry) {
            if (fname.value == '' || lname.value == '' || country.value == '' || province.value == '' || address.value == ''
                || postal.value == '' || phone.value == '' || credit.value == '' || expiry.value == '') {
                alert("Not all fields have been filled");
                return false;
            }
            form.submit()
            return true;
        }
    </script>

</head>

<body>
<div class="billingContainer">
<form action="makePayment.php" method="post">


    <input type="hidden" name="total" value="<?php echo number_format((float)($_SESSION['cart']), 2, '.', ''); ?>">
    <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" src="" align="left"
           style="margin-right:7px;" name="submit" alt="PayPal - The safer, easier way to pay online!">
    </input>
</form>
</div>



</body>

</html>