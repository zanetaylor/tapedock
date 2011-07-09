<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>Tapedock: <?=$page_title?></title>
	
	<meta name="description" content="">
	<meta name="author" content="">
	
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
	
	<link rel="stylesheet" href="<?=base_url()?>css/style.css?v=2">
	
	<script src="<?=base_url()?>js/libs/modernizr-1.6.min.js"></script>
</head>
<body>

	<div id="wrap">
		<header>
			<a id="logo" class="ir" href="<?=base_url()?>">Tapedock</a>
			<span id="tagline">share your music like it's 1989.</span>
		</header>
		<nav id="nav">
			<? $this->load->view('menu_view'); ?>
		</nav>
		<div id="main">
			<? if (isset($error)) echo $error; ?>
			<?=$content?>
		</div>
	</div><!--! end of #wrap -->
	<footer id="footer">
		<nav>
			<ul>
				<li><a href="<?=base_url()?>">home</a></li>
				<li><a href="<?=site_url("site/about")?>">about</a></li>
				<li><a href="<?=site_url("site/faq")?>">faq</a></li>
				<li><a href="<?=site_url("signup")?>">sign up</a></li>
				<li><a href="<?=site_url("blog")?>">blog</a></li>
				<li><a href="<?=site_url("site/terms")?>">terms</a></li>
				<li><a href="<?=site_url("site/privacy")?>">privacy</a></li>
				<li><a href="<?=site_url("site/feedback")?>">feedback</a></li>
			</ul>
		</nav>
		<p id="copyright">&copy; Copyright 2011 Zane Taylor</p>
	</footer>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?=base_url()?>js/jquery-1.4.3.min.js"><\/script>')</script>
	
	<script src="<?=base_url()?>js/libs/fileuploader.js"></script>
	<script src="<?=base_url()?>js/plugins.js"></script>
	<script src="<?=base_url()?>js/script.js"></script>
	
	<script src="<?=base_url()?>js/profiling/yahoo-profiling.min.js?v=1"></script>
	<script src="<?=base_url()?>js/profiling/config.js?v=1"></script>
	
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