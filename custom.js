/* JS File */

// Start Ready
$(document).ready(function () {

    // Icon Click Focus
    $('div.icon').click(function () {
        $('input#searchBar').focus();
    });

    // Live Search
    // On Search Submit and Get Results
    function search() {
        var query_value = $('input#searchBar').val();
        $('b#search-string').html(query_value);
        if (query_value !== '') {
            $.ajax({
                type: "POST",
                url: "search.php",
                data: { query: query_value },
                cache: false,
                success: function (html) {
                    $("div#searchGallery").html(html);
                }
            });
        }
        return false;
    }

    $("input#searchBar").keyup(function (e) {
        // Set Timeout
        clearTimeout($.data(this, 'timer'));

        // Set Search String
        var search_string = $(this).val();
        // Do Search
        if (search_string == "") {
            $("div#searchGallery").fadeOut(1);
            $('h4#searchGallery').fadeOut(1);
            $("div#gallery").fadeIn(1);
            $('h4#gallery').fadeIn(1);
        } else {
            $("div#gallery").fadeOut(1);
            $('h4#gallery').fadeOut(1);
            $("div#searchGallery").fadeIn(1);
            $('h4#searchGallery').fadeIn(1);
            $(this).data('timer', setTimeout(search, 50));
        }
        ;
    });

});