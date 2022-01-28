<?php
include("includes/header.php");
if(!$session->is_signed_in()){//testen of er een user ingelogd is (is er een session)
    redirect('login2.php');
}
if(empty($_GET['id'])){//get = pak die parameter 'id'
    redirect('categories.php');
}
$category = Category::find_by_id($_GET['id']);
if($category){
    $category->delete();
}else{
    redirect('categories.php');
}
?>


<?php
include("includes/sidebar.php");
include("includes/content-top.php");
?>




<h1>DELETE CATEGORY</h1>
<p>Watch out! This is a <strong> hard delete </strong> and  <strong> can NOT  </strong> be undone!  </p>
<?php
include("includes/footer.php");
?>

