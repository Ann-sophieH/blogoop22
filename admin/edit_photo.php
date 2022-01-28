<?php
include("includes/header.php");
if(!$session->is_signed_in()){//testen of er een user ingelogd is (is er een session)
    redirect('login2.php');
}

if(empty($_GET['id'])){//get = pak die parameter 'id'
    redirect('photos.php');
}else{ // belangrijkst
    $photo = Photo::find_by_id($_GET['id']); //ophalen foto uit db
    if(isset($_POST['update'])){ //if variable is set (declared) and != 0
        if($photo){
            $photo->title = $_POST['title'];
            $photo->alternate_text = $_POST['alternate_text'];
            $photo->description = $_POST['description'];
            $photo->set_file($_FILES['file']);
            $photo->update();
        }
    }


}

include("includes/sidebar.php");
include("includes/content-top.php");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>PHOTOS</h1>

            <form action="edit_photo.php?id=<?php echo $photo->id ?>" method="post" enctype="multipart/form-data">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="title">title</label>
                                <input type="text" name="title" class="form-control" value="<?php echo $photo->title ?>">
                            </div>
                            <div class="form-group" >
                                <label for="alternate_text">alt</label>
                                <input type="text" name="alternate_text" class="form-control" value="<?php echo $photo->alternate_text ?>">
                            </div>
                            <div class="form-group" >
                                <label for="description">Description</label>
                                <textarea  class="form-control" name="description" rows="4">
                                    <?php echo $photo->description ?>
                    </textarea>
                            </div>
                            <div class="form-group">
                                <input type="file" name="file" class="form-control" >
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <img src="<?php echo $photo->picture_path() ?>" class="img-fluid" >
                            <div id="imagedata">
                                <p><i class="fas fa-calendar pr-1"></i> Uploaded on: April 1 2021</p>
                                <p><i class="fas fa-file pr-1"></i> <?php echo $photo->filename ?></p>
                                <p><i class="fas fa-file-image pr-1"></i> <?php echo $photo->type?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="submit" name="update" value="update" class="btn btn-warning">
            </form>
        </div>
    </div>
</div>


<?php

include("includes/footer.php");
?>
