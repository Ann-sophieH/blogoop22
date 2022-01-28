<?php
include("includes/header.php");
require_once("admin/includes/init.php"); //want hebt comment class uit backend nodig
if(empty($_GET['id'])){
    redirect("index.php");
}
$category = Category::find_by_id($_GET['id']);
$photo_id = $_GET['id'];
$photo = Photo::find_by_id($_GET['id']); //http://localhost:63342/www/blogoop22/photo.php?=id=1 ->als er in tabel foto een id bestaat
//deze zoeken en weergeven. Nodig om de comment te kunnen ophalen uit db (ene kant nodig om andere kant op te zoekn)
//HAAL EEN BESTAANDE PRIMARY KEY OP UIT FOTOS
$comments = Comment::find_the_comment($photo->id); //comments hier gevuld vanuit db // FOREIGN KEY IN COMMENTS TABLE

$cat_ids = Photo::find_the_category_id($photo_id);

$all_photo_categories = [];
foreach ($cat_ids as $cat_id){
    $cat_id = implode("", $cat_id);
    $category_name =  Category::find_by_id($cat_id);
    $all_photo_categories[] = $category_name;
}

$all_categories = Category::find_all();



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
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1"><?php echo $photo->title; ?></h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Posted on January 1, 2021 by Start Bootstrap</div>
                    <!-- Post categories-->
                    <?php foreach ($all_photo_categories as $all_photo_category): //?>
                    <a class="badge bg-info opacity-75 text-decoration-none link-light" href="#!"><?php echo $all_photo_category->category_name ?></a>
                    <?php endforeach;?>

<!--                    <a class="badge bg-success opacity-75 text-decoration-none link-light" href="#!">Freebies</a>-->
                </header>
                <!-- Preview image figure-->
               <img class="img-fluid rounded mb-4" src="<?php echo 'admin'.DS.$photo->picture_path(); ?>" alt="..." />
                <!-- Post content-->
                <section class="mb-5">
                    <p><?php echo $photo->description; ?></p>
                </section>
            </article>
            <!-- Comments section-->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">
                        <!-- Comment form-->
                        <form method="post" class="mb-4">
                            <div class="mb-3">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" class="form-control" name="author" placeholder="Author name please...">
                            </div>
                            <textarea class="form-control mb-3" rows="3" name="body" placeholder="Join the discussion and leave a comment!"></textarea>
                            <button type="submit" name="submit" class="btn btn-outline-primary mb-2">
                                Submit
                            </button>
                        </form>

                        <!-- Single comment-->
                        <?php foreach ($comments as $comment): //?>
                        <div class="d-flex">
                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                            <div class="ms-3">
                                <div class="fw-bold"><?php echo $comment->author ?></div>
                                <p><?php echo $comment->body ?></p>
                            </div>
                        </div>
                         <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-header">Search</div>
                <div class="card-body">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                        <button class="btn btn-success opacity-75" id="button-search" type="button">Go!</button>
                    </div>
                </div>
            </div>
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