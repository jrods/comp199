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

    return;
}

function displayCart() {
    $('.cartContainer').html(function getCart(){
        var r = $.ajax({type: 'GET', url: 'viewCart.php', async: false}).responseText;
        return r;
    });
}

function makeMusicPlayer(div, address, album) {
    $(div).html(getPage(address, album));
}

function cartDisplay(e) {
    var gallery = document.getElementById('gallery')

    if(e.value === 'false') {
        displayCart();
        e.value = 'true';
        gallery.style.paddingTop = "225px";


    } else {
        function unDisplayCart() {
            var cart = document.getElementById('cart');
            var innerCart = document.getElementById('cartInfo')
            cart.removeChild(innerCart);
        }

        gallery.style.paddingTop = "0";
        unDisplayCart();
        e.value = 'false';
    }
}

function addItem(e) {
    postPage('addToCart.php', e.value);
    cartObject.value = 'false';
    cartDisplay(cartObject);
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

function playAlbum(albumId) {
    makeMusicPlayer('.musicPlayer', 'showSongs.php', albumId);
}