<?php
include("includes/header.php");
include("includes/sidebar.php");
include("includes/content-top.php");
?>
<?php
/**CODE VOOR HET FORMULIER**/
if(!$session->is_signed_in()){//testen of er een user ingelogd is (is er een session)
   redirect('login2.php');
}
/**vanaf hier code formulier*/
$message ="";
$photo = new Photo();
$categories = Category::find_all();

//$added_categories = [];

if(isset($_POST['submit'])){
    global $database;
    $photo->title = $_POST['title'];
    $photo->alternate_text = $_POST['alternate_text'];
    $photo ->description = $_POST['description'];
    $photo->set_file($_FILES['file']);
    if(!empty($_POST['category_name'])) { // cest quoi?
        foreach($_POST['category_name'] as $value){
            $value = $_POST['value'];
        }
    }
    if($photo->save()){
        $message = "Photo uploaded succesfully";
    }else{
        $message = join("<br>", $photo->errors);
    }
    $photo->startX = $_POST['startX'];
    $photo->startY = $_POST['startY'];
    $photo->set_imgick($photo->filename, $photo->startX, $photo->startY);

    $categoryArray = $_POST['categoryArray'];
    Photo::attachCategories($photo->id, $categoryArray);


   /* $image_path = IMAGES_PATH . DS . $photo->filename;
    $image_md = new Imagick($image_path);
    echo $image_path;
    $imageprops_md = $image_md->getImageGeometry();
    $width_md = $imageprops_md['width'];
    $height_md = $imageprops_md['height'];
    if ($width_md > $height_md) {
        $newHeight_md = 800;
        $newWidth_md = ($width_md / $height_md) * $newHeight_md;
    } else {
        $newWidth_md = 600;
        $newHeight_md = ($height_md / $width_md) * $newWidth_md;
    }
    $image_md->resizeImage(800, $newHeight_md, imagick::FILTER_LANCZOS, 1);
    $image_md->writeImage(IMAGES_PATH . DS . 'md_' .$filename);
    $image_sm->writeImage(IMAGES_PATH . DS . 'sm_' .$filename);
            $image_lg->writeImage(IMAGES_PATH . DS . 'lg_' .$filename);;*/
}

?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class=" p-3 mt-5 bg-white rounded">UPLOAD</h1>
                <hr>
            </div>
            <form action="upload_imagick.php" method="post" enctype="multipart/form-data" class="row mt-4">
                <div class="col-6">
                <div class="form-group">
                    <label for="title">title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="alternate_text">alt</label>
                    <input type="text" name="alternate_text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <input type="file" name="file" class="form-control">
                </div>
                <input type="submit" name="submit" value="upload imagick" class="btn btn-primary">
                </div>
            <div class="col-3">

                <p>Select the categories you want to add to your new post: </p>
                <?php foreach ($categories as $category): ?>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="categoryArray[]" value="<?php echo $category->id;?>"><?php echo $category->category_name;?>
                        </label>
                    </div>
                <?php endforeach;?>

            </div>
                <div class="col-3">
                <p>A thumbnail will be created from this image, select the position where you want the img to be cropped</p>

                <div class="form-group">
                    <label for="startX">Crop positioning TOP... </label>
                    <select name="startX" class="custom-select" id="startX" >
                            <option value="0">Left </option>
                            <option value="125">Center</option>
                            <option value="250">Right</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="startY" >Crop positioning LEFT... </label>
                    <select name="startY" class="custom-select" id="startY" >
                        <option value="0">Top </option>
                        <option value="125">Center</option>
                        <option value="250">Bottom</option>
                    </select>
                </div>
                </div>
            </form>
        </div>

    </div>
<?php
include("includes/footer.php");
?>