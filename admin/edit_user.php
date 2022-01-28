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
    redirect('users.php'); //leeg? => redirecten
}
$user = User::find_by_id($_GET['id']); //ophalen juiste user db
if(isset($_POST['update_user'])){
    if($user){
        $user->username = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->password = $_POST['password'];
        if(empty($_FILES['user_image'])){ //als deze file user img leeg is mag je saven
            $user->save();
        }else{ //anders is er img upgeload
            $user->set_file($_FILES['user_image']); //set file trekt foto uit elkaar
            $user->save_user_and_image();
            redirect("edit_user.php?id={$user->id}");
        }

    }
}


?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>EDIT USER </h1>

            <form action="edit_user.php?id=<?php echo $user->id; ?>" method="post" enctype="multipart/form-data">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="username">username</label>
                                <input type="text" name="username" class="form-control"  value="<?php echo $user->username ?>">
                            </div>
                            <div class="form-group" >
                                <label for="first_name">First name</label>
                                <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name ?>">
                            </div>
                            <div class="form-group" >
                                <label for="last_name">Last name</label>
                                <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">password</label>
                                <input type="password" name="password" class="form-control" value="<?php echo $user->password ?>">
                            </div>
                            <div class="form-group ">
                                <img width="60" height="60" src="<?php echo $user->image_path_and_placeholder();?>" class="img-fluid" >
                                <label for="user_image">File</label>
                                <input type="file" name="user_image" class="form-control" value="<?php echo $user->username ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <input type="submit" name="update_user" value="Update User" class="btn btn-warning">
            </form>
        </div>
    </div>
</div>

<?php
include("includes/footer.php");
?>