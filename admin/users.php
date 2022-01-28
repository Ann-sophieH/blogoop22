<?php
include("includes/header.php");
if(!$session->is_signed_in()){//testen of er een user ingelogd is (is er een session)
    redirect('login2.php');
}

$users = User::find_all();

include("includes/sidebar.php");
include("includes/content-top.php");


if(isset($_SESSION['msg'])){
    echo "<div class='alert alert-success mt-2' role='alert'>" . $_SESSION['msg'] . "</div>";
//var_dump($_SESSION['msg']);
    unset($_SESSION['msg']);
}

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="row justify-content-between mb-5 mt-5">
                <h1>ALL CONTACTS</h1>
                <button class="btn btn-outline-primary font-weight-bold rounded-pill"><a href="add_users.php"><i class="fas fa-user-plus mr-3"></i>Create new contact</a> </button>
            </div>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Delete User</th>
                    <th scope="col">Edit user</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($users as $user): ?>
                    <tr>
                        <th scope="row"><?php echo $user->id; ?></th>
                        <td><img class="rounded-circle img-fluid img-thumbnail" width="50" height="50" src="<?php echo $user->image_path_and_placeholder() ?>" alt="<?php echo $user->first_name . ' ' . $user->last_name ?>"><?php echo ' ' .$user->first_name . ' ' . $user->last_name ?></td>
                        <td><?php echo $user->username; ?></td>
                        <td><?php echo $user->first_name; ?></td>
                        <td><?php echo $user->last_name; ?></td>
                        <td class="text-center"><a href="delete_user.php?id=<?php echo $user->id ?>" class="btn btn-outline-danger"><i class="fas fa-fw fa-trash-alt text-center"></i></a></td>
                        <td class="text-center"><a href="edit_user.php?id=<?php echo $user->id ?>" class="btn  btn-outline-warning "><i class="fas fa-edit "></i></a><?php  ?></td>

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

