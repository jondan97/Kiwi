
//script checks whether terms and services box is checked or not. if it is, it disables the submition form.
$('input[name=checkbox]').change(
    function() {
        var value = $("input[name=checkbox]").attr('checked');
        if (value == false) {
            $('#submit-btn').hide();
        } else {
            $('#submit-btn').show();
        }
    });

//script which checks whether or not user has put correct pw and checked RC box, to enable cookies.
$(document).ready(function(){
	var rememberValue = $('.rememberPC').val();
	rememberValue.click(function() {
	    if ($(this).is(":checked")) {
	        var username = $("input[type=username]").attr("value");
			var password = $("input[type=password]").attr("value");
			$.cookie('username', username, { expires : 10 });
			$.cookie('password', password, { expires : 10 });
			$.cookie('rememberPC', true, { expires : 10 });
	    } else {
	        $.cookie('username', null);
			$.cookie('password', null);
			$.cookie('remember', null);
	    }
	    var remember = $.cookie('remember');
	    var pw = $.cookie('password');
		if ( (remember == 'true') && (pw == rememberValue) ) {
			var username = $.cookie('username');
			var password = $.cookie('password');
			$("input[type=username]").attr("value", username);
			$("input[type=password]").attr("value", password);
		}
});
});

