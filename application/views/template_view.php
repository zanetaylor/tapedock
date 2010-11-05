<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	
	<!-- www.phpied.com/conditional-comments-block-downloads/ -->
	<!--[if IE]><![endif]-->
	
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
	Remove this if you use the .htaccess -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title><?=$page_title?></title>
	
	<meta name="description" content="">
	<meta name="author" content="">
	
	<!--  Mobile Viewport Fix
	    j.mp/mobileviewport & davidbcalhoun.com/2010/viewport-metatag 
	device-width : Occupy full width of the screen in its current orientation
	initial-scale = 1.0 retains dimensions instead of zooming out if page height > device height
	maximum-scale = 1.0 retains dimensions instead of zooming in if page width < device width
	-->
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
	
	<!-- Place favicon.ico and apple-touch-icon.png in the root of your domain and delete these references -->
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	
	<!-- CSS : implied media="all" -->
	<link rel="stylesheet" href="<?=base_url()?>css/style.css?v=1">
	
	<!-- For the less-enabled mobile browsers like Opera Mini -->
	<link rel="stylesheet" media="handheld" href="<?=base_url()?>css/handheld.css?v=1">
	
	<!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
	<script src="<?=base_url()?>js/libs/modernizr-1.6.min.js"></script>
</head>
<body>

	<div id="wrap">
		<header>
			<a id="logo" class="ir" href="<?=base_url()?>">the mixtape project</a>
		</header>
		<navigation>
			<? $this->load->view('menu_view'); ?>
		</navigation>
		<section>
			<?=$content?>
		</section>
		<footer>
			<p>&copy; Copyright 2010 Zane Taylor</p>
		</footer>
	</div><!--! end of #wrap -->
	
	<!-- Grab Google CDN's jQuery. fall back to local if necessary -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?=base_url()?>js/jquery-1.4.3.min.js"><\/script>')</script>
	
	<!-- scripts concatenated and minified via ant build script-->
	<script src="<?=base_url()?>js/plugins.js"></script>
	<script src="<?=base_url()?>js/script.js"></script>
	<!-- end concatenated and minified scripts-->
	
	<!-- yui profiler and profileviewer - remove for production -->
	<script src="<?=base_url()?>js/profiling/yahoo-profiling.min.js?v=1"></script>
	<script src="<?=base_url()?>js/profiling/config.js?v=1"></script>
	<!-- end profiling code -->
	
	<!-- asynchronous google analytics: mathiasbynens.be/notes/async-analytics-snippet 
	change the UA-XXXXX-X to be your site's ID -->
	<script>
		var _gaq = [['_setAccount', 'UA-XXXXX-X'], ['_trackPageview']];
		(function(d, t) {
		var g = d.createElement(t),
		s = d.getElementsByTagName(t)[0];
		g.async = true;
		g.src = ('https:' == location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g, s);
		})(document, 'script');
	</script>
	
</body>
</html>