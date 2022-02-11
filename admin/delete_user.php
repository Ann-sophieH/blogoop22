<?php
include("includes/header.php");
if(!$session->is_signed_in()){//testen of er een user ingelogd is (is er een session)
    redirect('login2.php');
}
if(empty($_GET['id'])){//get = pak die parameter 'id'
    redirect('users.php');
}
$user = User::find_by_id($_GET['id']);
if($user){
    $user->delete_user_image();
    redirect('users.php');
}else{
    redirect('users.php');
}
?>


<?php
include("includes/sidebar.php");
include("includes/content-top.php");
?>




<h1>DELETE USER</h1>
<?php
include("includes/footer.php");
?>

