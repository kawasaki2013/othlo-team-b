<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>タイトル入力</title>
	</head>
	<body>
		<h2>第１食堂内でマッチングを行います。<br /></h2>

		<?php
		//データの受け取り
			$sid = $_POST['sid'];
            $venue = $_POST['venue'];

        print '【学籍番号="'.$sid.'"、詳細な場所!="'.$venue.'"】<br />';

		?>
	</body>
</html>
