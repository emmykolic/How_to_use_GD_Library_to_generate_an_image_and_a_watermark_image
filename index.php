<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>GD</title>
</head>
<body>
	<div>
		<form class="form" action="watermark_action.php" method="post" enctype="multipart/form-data">
		    <p>Select An Image File to Upload:</p>
		    <input class="files" type="file" name="i_file">
		    <p>Select Your Choice of watermark Image File to Upload:</p>
		    <input class="files" type="file" name="w_file">
		    <input type="submit" class="btn" name="submit" value="Upload">
		</form>
	</div>

</body>
</html>