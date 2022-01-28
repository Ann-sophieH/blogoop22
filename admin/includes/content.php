<!-- Content Row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <?php echo IMAGES_PATH; ?>
           <?php
                $photos = Photo::find_all();
                foreach($photos as $photo){
                    echo $photo->title . "<br>";
                }
           ?>
           <?php
                $photo = new Photo();
                $photo->title = "Kastaar";
                $photo->description="Lorem ipsum";
                $photo->size = 15;
                $photo->save();
           ?>

        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->