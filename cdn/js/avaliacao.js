$(function () {
	$("#estudante").autocomplete({
		source: function(request,response){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					response(JSON.parse(this.responseText));
				}
			};
			xmlhttp.open("GET", "getUsuario.php?nome=" + request.term, true);
			xmlhttp.send();
		},
		
		minLength:1,
		select: function(event, ui){
			
		}
	});
});

$(document).ready(function(){
  $('[data-toggle="popover"]').popover();
});
