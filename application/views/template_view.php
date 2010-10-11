<html>
	<head>
		<title><?=$page_title?></title>
		<?=link_tag('css/base.css')?>
	</head>
	<body>
		<h1>the mixtape project</h1>
		<? $this->load->view('menu_view'); ?>
		<?=$content?>
		<? if (isset($js_file)) { ?>
		<!-- <script type="text/javascript" charset="utf-8" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> -->
		<? } ?>
	</body>
</html>