$(document).ready(function() {

	initializeFancyBox();

});

function initializeFancyBox()
{
  /* Fire the fancybox plugin */
  $("a.fancybox").fancybox({
    'transitionIn'	:	'fade',
    'transitionOut'	:	'fade',
    'overlayShow'	:	true,
    'overlayOpacity' : 0.3,
    'overlayColor' : '#61717A',
    'cyclic' : true,
    'titlePosition' : 'over'
	 });
}