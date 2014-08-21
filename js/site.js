$(document).on('ready', function() {
	var $navMainMenu = $('#nav-main-menu');
	
	$navMainMenu.find('button').on('click', function() {
		$(this).toggleClass('toggle-on');
		
		$navMainMenu.find('nav').toggleClass('toggle-on');
	});
});