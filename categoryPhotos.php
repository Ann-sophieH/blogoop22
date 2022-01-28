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
$photo_ids = Category::find_the_photo_id($cat_id);

$all_photos_of_category = [];
foreach ($photo_ids as $photo_id){
    $cat_id = implode("", $cat_id);
    $category_name =  Category::find_by_id($cat_id);
    $all_photos_of_category[] = $category_name;
}




if(isset($_POST['submit'])){
    $author = trim($_POST['author']);
    $body = trim($_POST['body']);

    $new_comment = Comment::create_comment($photo ->id, $author, $body);

    if($new_comment && $new_comment->save()){
        redirect("photo.php?id={$photo->id}");
    }else{
        $message = "There are problems saving! ";
    }
}else{
    $author = "";
    $body = "";
}

?>
<!-- Page content-->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <div class="card" style="width: 18rem;">
                    <img src="<?php echo 'admin'.DS.$photo->picture_path(); ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $photo->title; ?></h5>
                        <p class="card-text"><?php echo $photo->description; ?></p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </article>
            <!-- Comments section-->
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">


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