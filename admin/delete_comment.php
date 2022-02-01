<?php
include("includes/header.php");
if(!$session->is_signed_in()){//testen of er een comment ingelogd is (is er een session)
    redirect('login2.php');
}
if(empty($_GET['id'])){//get = pak die parameter 'id'
    redirect('comments.php');
}
$comment = Comment::find_by_id($_GET['id']);
if($comment){
    $comment->delete();
    redirect("comments_photo.php?id={$comment->photo_id}");
}else{
    redirect("comments_photo.php?id={$comment->photo_id}");
}
?>


<?php
include("includes/sidebar.php");
include("includes/content-top.php");
?>

<h1>DELETE comment</h1>
<?php
include("includes/footer.php");
?>

