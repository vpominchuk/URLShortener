function evalJSON(str) {
	if(typeof str == 'undefined'){
		return {status: 'NOT_A_JSON'}
	}

	if (str.match(/^\{/)) {
		return $.parseJSON(str);
	}else{
		return {status: 'NOT_A_JSON'};
	}
}

function addLink() {
	var url = $('#url').val();
		
	if (!url) {
		$('.alert.success').addClass('hidden');
		$('.alert.warning').removeClass('hidden');
		return;
	}
	
	$.ajax({
		type: "POST",
		url: 'add.php',
		data: { url: url }
	}).done(function(response) {
		var response = evalJSON(response);
		
		if (response.status == 'OK') {
			$('.alert.warning').addClass('hidden');
			$('.alert.success').removeClass('hidden');
			
			$('.alert.success a').html(response.url).attr('href', response.url);
		}else{
		}
	});
}

$(function () {
	$('#submit').click(function() {
		addLink();
	});
	
	$('#url').keypress(function(e) {
		if(e.which == 13) {
			addLink();
		}
	});
})