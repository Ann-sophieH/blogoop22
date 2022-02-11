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

    if(!empty($_POST['category_name'])) {
        foreach($_POST['category_name'] as $value){
            $value = $_POST['value'];
        }
    }
    if($photo->save()){
        $message = "Photo uploaded succesfully";
    }else{
        $message = join("<br>", $photo->errors);
    }


    $categoryArray = $_POST['categoryArray'];
    Photo::attachCategories($photo->id, $categoryArray);
}


?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class=" p-3 mb-5 bg-white rounded">UPLOAD</h1>
            </div>
            <form action="upload.php" method="post" enctype="multipart/form-data" class="row">
                <div class="col-7">
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
                <input type="submit" name="submit" value="upload" class="btn btn-primary">
                </div>
            <div class="col-4">

                <h2>Select the categories you want to add to your new post: </h2>
                <?php foreach ($categories as $category): ?>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="categoryArray[]" value="<?php echo $category->id;?>"><?php echo $category->category_name;?>
                        </label>
                    </div>
                <?php endforeach;?>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="categoryArray[]" value="0">No categories
                    </label>
                </div>
            </div>
            </form>
        </div>

    </div>
<?php
include("includes/footer.php");
?>