<?php
include("includes/header.php");
if(!$session->is_signed_in()){//testen of er een user ingelogd is (is er een session)
    redirect('login2.php');
}

$photos = Photo::find_all();



include("includes/sidebar.php");
include("includes/content-top.php");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>PHOTOS</h1>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Title</th>
                    <th scope="col">File Name</th>
                    <th scope="col">Alt</th>
                    <th scope="col">Size</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($photos as $photo): ?>
                    <tr>
                        <th scope="row"><?php echo $photo->id; ?></th>
                        <td><img src='<?php echo $photo->picture_path_and_placeholder() ?>' height="62" width="62" alt="<?php echo $photo->title ?>"></td>
                        <td><?php echo $photo->title; ?></td>
                        <td><?php echo $photo->filename; ?></td>
                        <td><?php echo $photo->alternate_text; ?></td>
                        <td><?php echo $photo->size; ?></td>
                        <td><a href="delete_photo.php?id=<?php echo $photo->id ?>" class="btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i></a><?php  ?></td>
                        <td><a href="edit_photo.php?id=<?php echo $photo->id ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a><?php  ?></td>

                    </tr>
                <?php endforeach; ?>



                </tbody>
            </table>
        </div>
    </div>
</div>


<?php

include("includes/footer.php");
?>
