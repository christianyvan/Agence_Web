
	$(document).ready(function(){

		$('.menu-icon').click(function(e){
			e.preventDefault();
			$this = $(this);
		if($this.hasClass('is-opened')){
			$this.addClass('is-closed').removeClass('is-opened');
			document.getElementById("mySidenav").style.width = "0px";
		}else{
			$this.removeClass('is-closed').addClass('is-opened');
			document.getElementById("mySidenav").style.width = "400px";
		}

		})

	});



$(window).load(function() {
	$(".loader").fadeOut("1000");
})


