<?php
ob_start(); //dient als opvangbak voor de reply (omdat headers niet kunnen
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

$all_categories = Category::find_all(); // categorien in sidebar

$all_photo_categories = Photo::find_the_category_id($photo_id); //enkel categorieen gefilterde foto




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
                    <a href="categoryPhotos.php?id=<?php echo $all_photo_category->id ?>"  class="badge bg-info opacity-75 text-decoration-none link-light" href="#!"><?php echo $all_photo_category->category_name ?></a>

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
                       <?php if ($session->is_signed_in()) { ?>
                        <form method="post" class="mb-4">
                            <div class="mb-3">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" class="form-control" name="author" placeholder="Author name please...">
                            </div>
                            <textarea class="form-control mb-3" rows="3" name="body" placeholder="Join the discussion and leave a comment!"></textarea>
                            <button type="submit" name="submit" class="btn btn-outline-success opacity-75 mb-2">
                                Submit
                            </button>
                        </form>
                       <?php }?>
                        <!-- Single comment-->
                        <?php foreach ($comments as $comment): //?>
                        <div class="d-flex mb-4">
                            <!-- Parent comment-->
                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                            <div class="ms-3">
                                <div class="fw-bold"><?php echo $comment->author ?></div>
                                <p><?php echo $comment->body ?></p>
                                <!-- Reply form: only accessible when user is logged in -->
                                <?php  if ($session->is_signed_in()) { ?>
                                <button class="btn btn-outline-success opacity-75" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $comment->id ?>" aria-expanded="false" aria-controls="collapseExample">
                                    reply
                                </button>
                            <div class="collapse" id="collapse<?= $comment->id ?>">
                                <div class="card card-body bg-light mt-2 border-none shadow">
                                    <form method="post" class="mb-4 row ">
                                        <div class="mb-3">
                                            <label for="r_author" class="form-label">Author</label>
                                            <input type="text" class="form-control" name="r_author" placeholder="Author name please...">
                                        </div>
                                        <textarea class="form-control mb-3" rows="3" name="r_body" placeholder="Join the discussion and leave a reply!"></textarea>
                                        <button type="submit" name="submit_reply<?=$comment->id?>" class="btn btn-outline-success opacity-75 mb-2 col-2">
                                            Submit
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <?php }?>
                                <!-- Child comment 1-->
                                <?php
                                $replies = Reply::find_the_reply($comment->id);
                                $comment_id = $comment->id;
                                if(isset($_POST["submit_reply{$comment->id}"])){

                                    $replyAuthor = trim($_POST['r_author']);
                                    $replyBody = trim($_POST['r_body']);
                                    $new_reply = Reply::create_reply($comment_id, $replyAuthor, $replyBody);
                                    if($new_reply && $new_reply->save()){
                                        redirect("photo.php?id={$photo->id}");
                                    }else{
                                        $message = "There are problems saving! ";
                                    }

                                }

                                foreach ($replies as $reply): //?>
                                <div class="d-flex mt-4">
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                    <div class="ms-3">
                                        <div class="fw-bold"><?= $reply->r_author ?></div>
                                        <div class="row">
                                        <p><?php echo $reply->r_body ?></p>
                                        </div>
                                    </div>
                                </div>

                            <?php  endforeach; ?>
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

include("includes/footer.php");
ob_end_flush();
?>