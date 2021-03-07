(function( $ ) {
	'use strict';
	var _a = window._paq || [];
	_a.push(["setDocumentTitle", document.domain + "/" + document.title]);
	_a.push(['trackPageView']);
	_a.push(['enableLinkTracking']);
	(function() {
		var u="//stats.abeltra.me/js/";
		_a.push(['setTrackerUrl', u+'matomo.php']);
		_a.push(['setSiteId', '2']);
		var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
		g.type='text/javascript'; g.async=true; g.defer=true; g.src=u; s.parentNode.insertBefore(g,s);
	})();
})( jQuery );
