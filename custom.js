/* JS File */

// Start Ready
$(document).ready(function() {

	// Icon Click Focus
	$('div.icon').click(function(){
		$('input#searchBar').focus();
	});

	// Live Search
	// On Search Submit and Get Results
	function search() {
		var query_value = $('input#searchBar').val();
		$('b#search-string').html(query_value);
		if(query_value !== ''){
			$.ajax({
				type: "POST",
				url: "search.php",
				data: { query: query_value },
				cache: false,
				success: function(html){
					$("div#gallery1").html(html);
				}
			});
		}return false;
	}

	$("input#searchBar").keyup(function(e) {
		// Set Timeout
		clearTimeout($.data(this, 'timer'));

		// Set Search String
		var search_string = $(this).val();
		// Do Search
		if (search_string == "") {
		        $("div#gallery1").fadeOut(1);
			$('h4#gallery1').fadeOut(1);
			$("div#gallery2").fadeIn(1);
			$('h4#gallery2').fadeIn(1);
		}else{
		        $("div#gallery2").fadeOut(1);
			$('h4#gallery2').fadeOut(1);
			$("div#gallery1").fadeIn(1);
			$('h4#gallery1').fadeIn(1);
			$(this).data('timer', setTimeout(search, 50));
 	        };
	});

});