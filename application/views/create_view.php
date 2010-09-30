<html>
	<head>
		<title><?=$page_title?></title>
	</head>
	<body>
		<form name="create" method="post" action="<?=$this->config->item('index_page')?>/create">
			<dl>
				<dt>Title</dt>
					<dd><input name="name" /></dd>
				<dt>Description</dt>
					<dd><input name="description" /></dd>
			</dl>
		</form>
	</body>
</html>