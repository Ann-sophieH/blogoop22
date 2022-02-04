<?php
include("includes/header.php");
if(!$session->is_signed_in()){//testen of er een user ingelogd is (is er een session)
    redirect('login2.php');
}

$categories = Category::find_all();

include("includes/sidebar.php");
include("includes/content-top.php");




?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <?php if($session->message): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $session->message;?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <div class="row justify-content-between mb-5 mt-5">
                <h1>ALL CATEGORIES</h1>
                <button class="btn btn-outline-primary font-weight-bold rounded-pill"><a href="add_category.php"><i class="fas fa-user-plus mr-3"></i>Create new category</a> </button>
            </div>
            <div class="row">
           <?php foreach ($categories as $category): ?>
            <!-- Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    category </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $category->category_name ?></div>
                            </div>
                            <div class="col-auto">
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

