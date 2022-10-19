<?php session_start();
	$imagepath = $_SESSION['img']; 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="content-type" name="viewport" content="width=device-width, text/html initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<!-- <meta  content="; charset=UTF-8"> -->
	<title>GD</title>
</head>
<body>
	<h1>Your Result</h1>
    	<img src="<?=$imagepath ?>">
    	<a href="index.php" class="btns">Go back to for more Watermarking</a>
    	<iframe frameborder="0" width="70%" height="500px" src="https://GD-watermark.emmykolic.repl.co"></iframe>

</body>
</html>