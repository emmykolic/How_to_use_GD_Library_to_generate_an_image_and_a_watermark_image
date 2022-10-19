<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

<?php
session_start();
// //here we are sending this our raw code to a new page
 header("Location: other_file.php");

//hard code the image you want to watermark from the directory
 $image1 = 'image/camera.jpg';
  
 //hard code the watermark image from the directory
 $image2 = 'image/potato.png';
  
 //assign values to a list of variables in one operation
 list($width, $height) = getimagesize($image2);
  
 //returns an image identifier representing the image obtained from a given data
 $image1 = imagecreatefromstring(file_get_contents($image1));
 $image2 = imagecreatefromstring(file_get_contents($image2));
  
 //here we took a portion of a picture and combine it.
 imagecopymerge($image1, $image2, 104, 160, 0, 0, $width, $height, 100);
  
 //Create a PNG file and output it to a file or the browser.
 imagepng($image1);

 //if you want to save the merged image
 $image1 =  imagepng($image1, 'merged.png');
 $_SESSION['img'] = $image1;
  //header("Location: other_file.php");
?>

</body>
</html>