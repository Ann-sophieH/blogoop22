<?php
include("includes/header.php");
require_once("admin/includes/init.php");


$categories = Category::cats_w_photos(); //alle categorieën ophalen om in tabs weer te geven
$i = 0 //i op 0 zetten om de loop een teller te geven zodat je aan eerste element ervan kan

?>
    <div class="container-fluid">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <ul class="nav nav-pills mt-5 mb-3 justify-content-between " id="pills-tab" role="tablist">
                <?php foreach ($categories as $category): $i++ ?><!-- i om eerste element van de loop te vinden en active class aan te binden -->

                    <li class="nav-item" role="presentation"><!-- als i=1 is dan komt active class er bij -->
                        <button class="nav-link <?php if($i == 1) echo "active" ?>" id="pills-<?php echo $category->category_name ?>-tab" data-bs-toggle="pill"

                           href="#pills-<?php echo $category->category_name ?>" type="button" role="tablist"
                           aria-controls="pills-<?php echo $category->category_name ?>"
                           aria-selected="<?php echo ($i == 1) ?  "true" : "false" ?>"><?php echo $category->category_name ?></button>
                    </li>
                <?php endforeach; ?>
            </ul>


            <div class="tab-content" id="pills-tabContent">

                <?php $i=0; //i terug op nul zetten om weer aan eerste element te kunnen (anders stond ie op 10 van vorige loop)
                foreach  ($categories as $category): $i++ ?>
                <div class="tab-pane fade <?php if($i == 1)  echo "show active" ?>" id="pills-<?php echo $category->category_name ?>" role="tabpanel"
                     aria-labelledby="pills-<?php echo $category->category_name ?>-tab" >

                        <div class="row row-cols-4">
                            <?php $all_photos_of_category = Category::find_the_photo_id($category->id);

                            ?>
                            <?php foreach ($all_photos_of_category as $one_photo_cat): ?> <!-- fotos van cat 1 voor 1 in cards laden -->
                                <article class="col g-2">
                                    <div class="card " style="width: 18rem;">
                                        <img src="<?php echo 'admin' . DS . $one_photo_cat->picture_path(); ?>"
                                             class="card-img-top img-fluid" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $one_photo_cat->title; ?></h5>
                                            <p class="card-text"><?php echo $one_photo_cat->description; ?></p>
                                            <a href="photo.php?id=<?php echo $one_photo_cat->id ?>"
                                               class="btn btn-primary">Go To
                                                blogpost</a>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>

                        </div>



                </div>
                <?php endforeach; ?>
            </div>
            <div class="col-2"></div>
        </div>
    </div>

<?php include("includes/footer.php"); ?>