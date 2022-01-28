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
if(empty($_GET['id'])){ //controle of er id is als parameter in url pagina
    redirect('categories.php'); //leeg? => redirecten
}
$category = Category::find_by_id($_GET['id']);
if(isset($_POST['update_category'])){
    if($category){
        $category->category_name = $_POST['category_name'];
        $category->save();
        $session->message("The category {$category->category_name} has been edited succesfully!");
        redirect('categories.php');
    }
}


?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>EDIT CATEGORY </h1>

                <form action="edit_category.php?id=<?php echo $category->id; ?>" method="post" enctype="multipart/form-data">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="category_name">Category name: </label>
                                    <input type="text" name="category_name" class="form-control"  value="<?php echo $category->category_name ?>">
                                </div>

                            </div>
                        </div>
                    </div>
                    <input type="submit" name="update_category" value="Update category" class="btn btn-warning">
                </form>
            </div>
        </div>
    </div>

<?php
include("includes/footer.php");
?>