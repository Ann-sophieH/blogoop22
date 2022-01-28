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
/**vanaf hier code formulier*/

$user = new User();

if(isset($_POST['add_user'])){

    $user->username = trim($_POST['username']);
    $user->first_name =  $_POST['first_name'];
    $user ->last_name =  trim($_POST['last_name']);
    $user ->password =  trim($_POST['password']);
    $user->set_file($_FILES['user_image']);

    //$user->save_user_and_image();
    if($user->save_user_and_image()){
       $_SESSION['msg'] = "user added succesfully" ;
        redirect('users.php');
    }else{
        $_SESSION['msg_bad'] = "user could not be added" ;
    }
}

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>ADD NEW USER </h1>

            <form action="add_users.php" method="post" enctype="multipart/form-data">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="username">username</label>
                                <input type="text" name="username" class="form-control" >
                            </div>
                            <div class="form-group" >
                                <label for="first_name">First name</label>
                                <input type="text" name="first_name" class="form-control">
                            </div>
                            <div class="form-group" >
                                <label for="last_name">Last name</label>
                                <input type="text" name="last_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">password</label>
                                <input type="password" name="password" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="user_image">File</label>
                                <input type="file" name="user_image" class="form-control" >
                            </div>
                        </div>

                    </div>
                </div>

                <input type="submit" name="add_user" value="Add User" class="btn btn-warning">
            </form>
        </div>
    </div>
</div>

<?php
include("includes/footer.php");
?>