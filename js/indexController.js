/**
 * Created by jaredsmith on 2014-06-19.
 */

var cartObject = document.getElementById('cartButton');
var gallery = document.getElementById('gallery');

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
    $.ajax({
        type: 'GET',
        url: 'viewCart.php',
        async: true,
        cache: false,
        success: function(response) {
            $('#cart').html(response).slideDown({ duration: 650, easing: 'linear'});
        }
    }).done( function() {
        $(document).ready(function(e) {
            $('#gallery').css('height', window.innerHeight);

            var padding = document.getElementById('cartInfo').scrollHeight;

            gallery.style.cssText = 'height:' + window.innerHeight +
                'px;padding-top: ' + padding + 'px;transition:padding 0.5s linear;';
        });
    });;
}

function makeMusicPlayer(div, address, album) {
    $(div).html(getPage(address, album));
}

function cartDisplay(e) {

    if(e.value === 'false') {
        displayCart();
        e.value = 'true';

    } else {
        gallery.style.paddingTop = "0";
        e.value = 'false';
        $('#cart').slideUp({ duration: 450, easing: 'linear'},
            function() {
                $('#cartInfo').remove();
            }
        );
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
    $('.rightSidebar').hide();

    var gallery = document.getElementById('galleryWrapper');
    gallery.removeChild(document.getElementById('galleryContent'));

    gallery.style.cssText = "width: 1110px;height:" + window.innerHeight + 'px;margin-top:0;transition:width 0.5s linear;';

    $(gallery).html(getPage('myCart.php'));

}

function clearTheCart(e) {

    $.ajax({
        type: 'POST',
        url: 'removeFromCart.php',
        data: {'removeAll': 'removeAll'}
    });

    cartObject.value = 'false';
    cartDisplay(cartObject);
}

function playAlbum(albumId) {
    makeMusicPlayer('.musicPlayer', 'showSongs.php', albumId);
}