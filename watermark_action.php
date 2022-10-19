<?php 
    session_start();
    // Path configuration
    $error = 0;
    $error_msg = "";

    function make_image($ext, $src){
        $ext = strtolower($ext);
        switch ($ext) {
            case 'jpg':
                return $result = imagecreatefromjpeg($src);
            break;
            case 'jpeg':
                return $result = imagecreatefromjpeg($src);
            break;
            case 'png':
                return $result = imagecreatefrompng($src);
            default:
                return $result = imagecreatefromjpeg($src);
            break;
        }
    }
    $targetDir = "image/";
    $image = $_FILES['i_file'];
    $watermark = $_FILES['w_file'];
    if ($image['error'] != 0 || $watermark['error'] !=0) {
        $error = 1;
        $error_msg.="error uploading image <br>";
    }

    $realimage = $image['tmp_name'];
    $realwatermark = $watermark['tmp_name'];

    $imagepath = $targetDir . sha1(microtime()) . $image['name'];
    $watermarkpath = $targetDir . sha1(microtime()) . $watermark['name'];
    
    $image_ext = pathinfo($image['name'],PATHINFO_EXTENSION); 
    $watermark_ext = pathinfo($watermark['name'], PATHINFO_EXTENSION);

    $allowedType = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
    if (in_array($image_ext, $allowedType)) {

        if (in_array($watermark_ext, $allowedType)) {
            move_uploaded_file($realwatermark, $watermarkpath);
            move_uploaded_file($realimage, $imagepath);
            $p_image = make_image($image_ext, $imagepath);
            $p_watermark = make_image($watermark_ext, $watermarkpath);
        }else{
            $error = 1;
            $error_msg.="Invalid watermark Type";
        }
       
    }else{
        $error = 1;
        $error_msg.="Invalid image Type";
    }
    //Set the margins for the watermark 
    $marge_right = 10; 
    $marge_bottom = 10;

    // Get the height/width of the watermark image
    $sx = imagesx($p_watermark);
    $sy = imagesy($p_watermark);

    // Copy the watermark image onto our photo using the margin offsets and  
    // the photo width to calculate the positioning of the watermark. 
    imagecopy($p_image, $p_watermark, imagesx($p_image) - $sx - $marge_right, imagesy($p_image) - $sy - $marge_bottom, 0, 0, imagesx($p_watermark), imagesy($p_watermark));
    //Save the image
    imagepng($p_image, $imagepath);
    imagedestroy($p_image);    
    $_SESSION['img'] = $imagepath;
    header("Location: watermark.php");
    echo "error code $error error_msg $error_msg $image_ext $watermark_ext";
    // $watermarkImagePath = 'image/ab-img.png';

    // if (isset($_POST['submit'])) {
    //     if (!empty($_FILES['i_file']['name'] || $_FILES['w_file']['name'])) {
    //         // File upload path
    //     $fileName = basename($_FILES['i_file']['name']);
    //     $watermarkName = basename($_FILES["w_file"]["name"]);
    //     $watermarkName = $targetDir . $watermarkName;
    //     $targetFilePath = $targetDir . $fileName; 
    //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION); 
    //     $watermarkType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    //     //Allow Certain file format
    //     $allowedType = array('jpg', 'jpeg', 'png');
    //     if (in_array($fileType, $allowedType) && in_array($watermarkType, $allowedType)) {
    //         //Upload File To The Server
    //         if (move_uploaded_file($_FILES['w_file']['name'], $watermarkName) && move_uploaded_file($_FILES['i_file']['name'], $targetFilePath)) {
    //             // Load the stamp and the photo to apply the watermark to
    //               switch ($watermarkType) {
    //                 case 'jpg':
    //                     $wm = imagecreatefromjpeg($watermarkName);
    //                     break;
    //                 case 'jpeg':
    //                     $wm = imagecreatefromjpeg($watermarkName);
    //                 break;
    //                 case 'png':
    //                     $wm = imagecreatefrompng($watermarkName);
    //                 default:
    //                     $wm = imagecreatefromjpeg($watermarkName);
    //                     break;
    //             }
    //             switch ($fileType) {
    //                 case 'jpg':
    //                     $im = imagecreatefromjpeg($targetFilePath);
    //                     break;
    //                 case 'jpeg':
    //                     $im = imagecreatefromjpeg($targetFilePath);
    //                 break;
    //                 case 'png':
    //                     $im = imagecreatefrompng($targetFilePath);
    //                 default:
    //                     $im = imagecreatefromjpeg($targetFilePath);
    //                     break;
    //             }
    //             // Set the margins for the watermark 
    //             $marge_right = 10; 
    //             $marge_bottom = 10;

    //             // Get the height/width of the watermark image
    //             $sx = imagesx($wm);
    //             $sy = imagesy($wm);

    //             // Copy the watermark image onto our photo using the margin offsets and  
    //             // the photo width to calculate the positioning of the watermark. 
    //             imagecopy($im, $wm, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($wm), imagesy($wm));

    //             //Save the image
    //             $_SESSION['img'] = $targetFilePath;
    //             header("Location: watermark.php"); 
    //             imagepng($im, $targetFilePath);
    //             imagedestroy($im);
    //         }
    //     }
    //     }
    // }
?>