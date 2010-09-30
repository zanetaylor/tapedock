<html>
	<head>
		<title><?=$page_title?></title>
	</head>
	<body>
		<ul>
			<? foreach($tapes as $row) : ?>
			<li><?=$row->title?></li>
			<? endforeach; ?>
		</ul>
	</body>
</html>