<?php
include("includes/header.php");
if(!$session->is_signed_in()){//testen of er een user ingelogd is (is er een session)
    redirect('login2.php');
}

$photos = Photo::find_all();
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 4;
$items_total_count = Photo::count_all();
$paginate = new Paginate($page, $items_per_page, $items_total_count);

$sql = "SELECT * FROM photos ";
$sql .= "LIMIT {$items_per_page} ";
$sql .= "OFFSET {$paginate->offset()}";
$photos = Photo::find_this_query($sql);




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
                    <th scope="col">#Comments </th>
                    <th scope="col">Categories </th>
                    <th scope="col">Delete, edit, view </th>

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
                        <td><a href="comments_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-primary fas fa-comment">
                           <?php  $comments = Comment::find_the_comment($photo->id);
                            echo count($comments);
                           ?>
                            </a>
                        </td>
                        <td>
                            <?php
                            $attachedCategories= $photo->find_the_category_id($photo->id);?>
                            <?php
                            foreach($attachedCategories as $category): ?>
                                <a class="badge bg-success text-decoration-none text-white link-light"
                                   href="#!">
                                    <?php
                                    echo $category->category_name;
                                    ?>
                                </a>
                            <?php endforeach; ?>
                        </td>
                        <td><a href="delete_photo.php?id=<?php echo $photo->id ?>" class="btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i></a><?php  ?></td>
                        <td><a href="edit_photo.php?id=<?php echo $photo->id ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a><?php  ?></td>
                        <td><a href="../photo.php?id=<?php echo $photo->id; ?>" class="btn btn-secondary"><i class="fas fa-eye"></i></a></td>

                    </tr>
                <?php endforeach; ?>



                </tbody>
            </table>
        </div>
    </div>
</div>
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <?php
        if ($paginate->page_total() > 1) {
            if ($paginate->has_previous()) {
                echo "<li class='previous page-item'><a href='photos.php?page={$paginate->previous()}' class='page-link'>Previous</a></li>";
            }
            for ($i = 1; $i <= $paginate->page_total(); $i++) {
                if ($i == $paginate->current_page) {
                    echo "<li class='active page-item'><a href='photos.php?page={$i}' class='page-link'>{$i}</a></li>";
                } else {
                    echo "<li class='page-item'><a href='photos.php?page={$i}'class='page-link'>{$i}</a></li>";
                }
            }
            if ($paginate->has_next()) {
                echo "<li class=' page-item'><a href='photos.php?page={$paginate->next()}' class='page-link'>Next</a></li>";
            }
        }
        ?>

    </ul>
</nav>


<?php
include("includes/footer.php");
?>
