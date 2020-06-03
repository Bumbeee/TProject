setTimeout(function(){
	document.body.classList.add('body_visible');
}, 200);


$(document).on('click' , '#gr_find', function(){
		var instrument = $('.instrument').val();
		var experience = $('.experience').val();
		var genre = $('.genre').val();
		var about_you = $('.about_you').val();
		var vipcode = $('.vipcode').val();

    $('.instrument').val('');
    $('.experience').val('');
    $('.genre').val('');
		$('.about_you').val('');
		$('.vipcode').val('');

    $.ajax({
        url: "functions.php?action=musicians_request",
        type: "POST",
        data: {instrument:instrument, experience:experience, genre:genre, about_you:about_you, vipcode:vipcode},
        success: function(result) {
            alert("Done");
        }
    });
    return false;
});


$("[data-tooltip]").mousemove(function (eventObject) {
		$data_tooltip = $(this).attr("data-tooltip");
		$("#tooltip").text($data_tooltip)
								 .css({
										 "top" : eventObject.pageY + 5,
										"left" : eventObject.pageX + 5
								 })
								 .show();
}).mouseout(function () {
		$("#tooltip").hide()
								 .text("")
								 .css({
										 "top" : 0,
										"left" : 0
								 });
});
