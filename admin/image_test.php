<?php
include("includes/header.php");
include("includes/sidebar.php");
include("includes/content-top.php");


$image_path = IMAGES_PATH.DS.'20201218_201817.jpg';
echo $image_path;


$image = new Imagick($image_path); // $image_path is the path to the image location
$imageprops = $image->getImageGeometry();
$width = $imageprops['width'];
$height = $imageprops['height'];
if($width > $height){
    $newHeight = 800;
    $newWidth = ($width / $height) * $newHeight;
}else{
    $newWidth = 600;
    $newHeight = ($height / $width) * $newWidth;
}
$image->resizeImage(800,600,imagick::FILTER_LANCZOS,1);
$image->writeImage(IMAGES_PATH.DS.'20201218_201817_resized.jpg');



include("includes/footer.php");
?>