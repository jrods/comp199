<!DOCTYPE html>
<html lang="en">
<head>

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

    <?php
    include('scripts/php/htmlGenerator.php');
    include('scripts/php/shoppingCart.php');
    include_once 'scripts/php/db_connect.php';
    include_once 'scripts/php/functions.php';

    @session_start();

    if(! isset($_SESSION['cart'])) {
        $_SESSION['cart'] = 0;
    }

    ?>

    <style type="text/css">
        .billingContainer {
            margin: 0 auto !important;
            width: 1110px;
        }

        .billingContainer form {
            height: 400px;
        }

        fieldset#checkout {
            display: inline-block;
            width: 1100px;
            padding: 0;
            margin: 10px;
            border: none;
        }

        fieldset#billInfo {
            width: 375px;
        }

        fieldset input {
            font-size: 16px;
            width: 250px;
            margin: 4px 4px 10px 50px;
        }

        legend {
            font-size: 24px;
            margin-left: 20px;
        }

        div.row {
            width: 400px;
            margin-left: 50px;
        }

        div#info span {
            margin-left: 50px;
        }

        #cart {
            float: right;
            width: 600px;
            margin-top: 4px;
            margin-right: 50px;
        }

        #paypal {
            width: 150px;
            margin-left: 100px;
        }

    </style>

</head>
<body>
<div class="billingContainer">
    <form action="makePayment.php" method="post">
        <fieldset id="checkout">
            <legend>Checkout</legend>

            <div id="cart" class="displayCart">

            </div>

            <fieldset id="billInfo">
                <legend>Billing Information</legend>
                <div class="row">
                <span class="form_element">

                    <input type="text"
                           name="firstname"
                           required id="firstname"
                           placeholder="Your First Name">
                </span>
                </div>

                <div class="row">
                <span class="form_element">
                    <input type="text"
                           name="lastname"
                           required id="lastname"
                           placeholder="Your Last Name">
                </span>
                </div>

                <div class="row">
                <span class="form_element">
                    <input type="text"
                           name="Country"
                           required id="Country"
                           placeholder="Enter Your Country">
                </span>
                </div>

                <div class="row">
                <span class="form_element">
                    <input type="text"
                           name="Province"
                           required id="province"
                           placeholder="Province Or State">
                </span>
                </div>

                <div class="row">
                <span class="form_element">
                    <input type="text"
                           name="Address"
                           required id="Address"
                           placeholder="Enter Your Address">
                </span>
                </div>

                <div class="row">
                <span class="form_element">
                    <input type="text"
                           name="postal"
                           required id="postal"
                           placeholder="Postal Code Or Zip">
                </span>
                </div>

                <div class="row">
                <span class="form_element">
                    <input title="Expected format as 250-999-9999"
                           type="tel"
                           name="phone"
                           required id="phone"
                           placeholder="250-999-9999">
                </span>
                </div>
                <!--
                            <div class="row">
                                <span class="form_element">
                                    <input type="text"
                                           name="credit"
                                           required id="credit"
                                           placeholder="Credit Card number">
                                </span>
                            </div>

                            <div class="row">
                                <span class="form_element">
                                    <input type="text"
                                           name="expiry"
                                           required id="expiry"
                                           placeholder="Credit card expiry"
                                           title="Credit card expiry as MM-YY">
                                </span>
                            </div>-->

                <button type="button" style="border: 0; background: transparent" onclick="return formhash(this.form, this.form.firstname,
														   this.form.lastname,
														   this.form.Country,
														   this.form.Province,
														   this.form.Address,
														   this.form.postal,
														   this.form.phone,
														   this.form.credit,
														   this.form.expiry);"></button>

                <input type="hidden" name="total"
                       value="<?php echo number_format((float)($_SESSION['cart']), 2, '.', ''); ?>">
                <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" src="" align="left"
                       style="margin-right:7px;" name="submit" id="paypal"
                       alt="PayPal - The safer, easier way to pay online!">
                </input>
            </fieldset>
        <script>
            function getPage(address) {
                var r = $.ajax({
                    type: 'GET',
                    url: address,
                    async: false
                }).responseText;

                return r;
            }

            function displayPage(div, address) {
                $(div).html(getPage(address));
            }

            $(document).ready(function (e) {
                displayPage('.displayCart', 'viewCart.php');

            });

        </script>

        </fieldset>
    </form>
</div>
</body>

<footer class="footer fixed bar">
    <div>
        <span id="whiteText">Copyright &copy; 2014</span><br/>
        <span id="whiteText">Authors: Sam Beveridge, Calvin Lam, Jared Smith</span>
    </div>
</footer>
</html>