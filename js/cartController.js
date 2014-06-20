/**
 * Created by jaredsmith on 2014-06-19.
 */

var cartObject = document.getElementById('removeItem');

function getPage(address, album) {
    var r = $.ajax({
        type: 'GET',
        url: address,
        data: {'name': album},
        async: false
    }).responseText;

    return r;
}

function postPage(address, album) {
    $.ajax({
        type: 'POST',
        url: address,
        data: {'name': album},
        async: false
    });
}

function displayPage(div, address, album) {
    $(div).html(getPage(address, album));
}

function cartDisplay(e) {
    if(e.value === 'false') {
        displayPage('.cartContainer', 'viewCart.php');
        e.value = 'true';
    } else {
        function unDisplayCart() {
            var cart = document.getElementById('cart');
            var innerCart = document.getElementById('cartInfo')
            cart.removeChild(innerCart);
        }

        unDisplayCart();
        e.value = 'false';
    }
}

function removeItem(e) {
    postPage('removeFromCart.php', e.value);
    cartObject.value = 'false';
    cartDisplay(cartObject);
}

function checkout(e) {
    cartObject.value = 'true';
    cartDisplay(cartObject);

    getPage('myCart.php');

}

function clearTheCart(e) {
    function clearIt() {
        $.ajax({
            type: 'POST',
            url: 'removeFromCart.php',
            data: {'removeAll': 'removeAll'},
            async: false
        })
    }

    clearIt();
    cartObject.value = 'false';
    cartDisplay(cartObject);
}

$('a#album').click(function (e) {
    var myClass = $(this).attr("class");
    displayPage('.musicPlayer', 'showSongs.php', myClass);
});

$('button#addToCart').click(function (e) {
    var name = $(this).attr("name");
    var albumName = $('button[name=' + name + ']').val();

    postPage('addToCart.php', albumName);
    cartObject.value = 'true'
    displayPage('.cartContainer', 'viewCart.php');
});
