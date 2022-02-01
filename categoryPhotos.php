<?php
include("includes/header.php");
require_once("admin/includes/init.php"); //want hebt comment class uit backend nodig
if(empty($_GET['id'])){
    redirect("index.php");
}
$all_categories = Category::find_all();
$category = Category::find_by_id($_GET['id']);

$photos = Photo::find_all();

$cat_id = $_GET['id'];

$all_photos_of_category = Category::find_the_photo_id($cat_id);






?>
<!-- Page content-->
<div class="container mt-5">

    <div class="row">
        <div class="col-lg-10 d-flex ">
            <!-- Post content-->
            <?php foreach ($all_photos_of_category as $one_photo_cat):
               ;?>
            <article class="col-6 col-md-4 g-2">
                <div class="card " style="width: 18rem;">
                    <img src="<?php echo 'admin'.DS.$one_photo_cat->picture_path(); ?>" class="card-img-top img-fluid" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $one_photo_cat->title; ?></h5>
                        <p class="card-text"><?php echo $one_photo_cat->description; ?></p>
                        <a href="photo.php?id=<?php echo $one_photo_cat->id ?>" class="btn btn-primary">Go To blogpost</a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
            <!-- Comments section-->
        </div>
        <!-- Side widgets-->
        <div class="col-lg-2">


            <!-- Categories widget-->
            <div class="card mb-4">
                <div class="card-header">All categories</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                        <?php foreach ($all_categories as $one_category): //?>
                                <li><a href="#!" class="link-info"><?php echo $one_category->category_name ?></a></li>
                 <?php endforeach;?>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Side widget-->
            <div class="card mb-4">
                <div class="card-header">Side Widget</div>
                <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
            </div>
        </div>
    </div>
</div>

<?php
include("includes/footer.php")
?>