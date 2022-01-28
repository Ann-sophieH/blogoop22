<?php
include("includes/header.php");
include("includes/sidebar.php");
include("includes/content-top.php");
?>
<?php
if(!$session->is_signed_in()){//testen of er een user ingelogd is (is er een session)
    redirect('login2.php');
}
/**vanaf hier code formulier*/

$category = new Category();
$categories = Category::find_all();

if(isset($_POST['add_category'])){
    $category->category_name = trim($_POST['category_name']);
    $category->save();
    $session->message("The category {$category->category_name} has been added succesfully!");
    redirect('categories.php');
}

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="mt-5">ADD NEW CATEGORY </h1>

            <form action="add_category.php" method="post" enctype="multipart/form-data">
                <div class="container">
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label for="category_name">category name</label>
                                <input type="text" name="category_name" class="form-control" >
                            </div>
                    </div>
                </div>
                <input type="submit" name="add_category" value="Add category" class="btn btn-success">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h2 class="mt-5 mb-4">Categories previously created: </h2>
            <div class="">
            <?php foreach ($categories as $category): ?>
                <!-- Card Example -->
                <div class="col-md-6 mb-4">
                    <div class="card border-left-secondary shadow h-100 py-2">
                        <div class="card-body">
                            <div class=" no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        category </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $category->category_name ?></div>
                                </div>
                                <div class="col-auto pt-2">
                                    <a href="delete_category.php?id=<?php echo $category->id ?>" class="btn btn-outline-danger"><i class="fas fa-fw fa-trash-alt text-center"></i></a>
                                    <a href="edit_category.php?id=<?php echo $category->id ?>" class="btn  btn-outline-warning "><i class="fas fa-edit "></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
            </div>
        </div>

    </div>
</div>

<?php
include("includes/footer.php");
?>