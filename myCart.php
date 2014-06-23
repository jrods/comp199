<!DOCTYPE html>
<html lang="en">
<head>

    <script src="js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/imagesloaded.pkg.min.js"></script>

    <script>
        function formhash(form, fname, lname, country, province, address, postal, phone, credit, expiry) {
            if (fname.value == '' || lname.value == '' || country.value == '' || province.value == '' || address.value == ''
                || postal.value == '' || phone.value == '' || credit.value == '' || expiry.value == '') {
                alert("Not all fields have been filled");
                return false;
            }
            form.submit();
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
            float: left;
            width: 375px;
            margin-top: 10px;
        }

        fieldset input {
            font-size: 16px;
            width: 250px;
            margin: 7px 0;
        }

        legend {
            font-size: 24px;
            margin: 0 20px 10px;
        }

        div.row {
            width: 300px;
            margin-left: 25px;
        }

        div#info span {
            margin-left: 50px;
        }

        #finalCart {
            float: left;
            width: 650px;
            margin-top: 30px;
            margin-left: 30px;
        }

        #paypal {
            width: 150px;
            margin-left: 100px;
        }

    </style>

    <script>
        $(document).ready( function (e) {
            $.ajax({
                type: 'GET',
                url: 'viewCart.php',
                async: true,
                cache: false,
                success: function(response) {
                    $('#finalCart').html(response);
                }
            }).done(function() {
                $('div#formCheckout').remove();
            })
        });
    </script>

</head>
<body>
<div class="billingContainer">
    <form action="makePayment.php" method="post">
        <fieldset id="checkout">
            <legend><h3>Checkout</h3></legend>

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
            <div id="finalCart">

            </div>
        </fieldset>
    </form>
</div>
</body>
</html>