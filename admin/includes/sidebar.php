<body id="page-top">
<?php
ob_start();
?>
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
<div class="d-flex">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-hippo"></i>
            </div>
            <div class="sidebar-brand-text mx-3">CMS</div>

        </a>
    <!-- Sidebar Toggler (Sidebar) -->

    <div class="text-center d-none d-md-inline mt-3">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
</div>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="../../blogoop22/index.php">
                <i class="fas fa-fw fa-landmark"></i>
                <span>Frontend</span></a>
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Users
        </div>
        <!-- Nav Item - ALL USERS -->
        <li class="nav-item">
            <a class="nav-link" href="users.php">
                <i class="fas fa-fw fa-users"></i>
                <span>All users</span></a>
        </li>
        <!-- Nav Item - CHANGE USER -->
        <li class="nav-item">
            <a class="nav-link" href="add_users.php">
                <i class="fas fa-fw fa-user-plus"></i>
                <span>Add new user</span></a>
        </li>


      <!--  Nav Item - Pages Collapse Menu
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Components</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Components:</h6>
                    <a class="collapse-item" href="buttons.html">Buttons</a>
                    <a class="collapse-item" href="cards.html">Cards</a>
                </div>
            </div>
        </li>

         Nav Item - Utilities Collapse Menu
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Utilities</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Utilities:</h6>
                    <a class="collapse-item" href="utilities-color.html">Colors</a>
                    <a class="collapse-item" href="utilities-border.html">Borders</a>
                    <a class="collapse-item" href="utilities-animation.html">Animations</a>
                    <a class="collapse-item" href="utilities-other.html">Other</a>
                </div>
            </div>
        </li>
-->
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Photos
        </div>
        <!-- Nav Item - All pictures -->
        <li class="nav-item">
            <a class="nav-link" href="photos.php">
                <i class="fas fa-fw fa-camera-retro"></i>
                <span>All pictures</span></a>
        </li>
        <!-- Nav Item - UPLOAD -->
        <li class="nav-item">
            <a class="nav-link" href="upload.php">
                <i class="fas fa-fw fa-upload"></i>
                <span>Upload new picture</span></a>
        </li>
        <!-- Divider -->
        <li class="nav-item">
            <a class="nav-link" href="upload_imagick.php">
                <i class="fas fa-fw fa-upload"></i>
                <span>Upload new picture in different sizes</span></a>
        </li>
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Categories
        </div>

        <!-- Nav Item - category collapse Menu -->
        <!-- Nav Item - category -->
        <li class="nav-item">
            <a class="nav-link" href="categories.php">
                <i class="fas fa-fw fa-folder-open"></i>
                <span>All categories</span></a>
        </li>
        <!-- Nav Item - UPLOAD -->
        <li class="nav-item">
            <a class="nav-link" href="add_category.php">
                <i class="fas fa-fw fa-folder-plus"></i>
                <span>Add new category</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Comments
        </div>
        <!-- Nav Item - All pictures -->
        <li class="nav-item">
            <a class="nav-link" href="comments.php">
                <i class="fas fa-fw fa-comment"></i>
                <span>All comments</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            Components
        </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
               aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Pages</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Login Screens:</h6>
                    <a class="collapse-item" href="../login.php">Login</a>
                    <a class="collapse-item" href="register.html">Register</a>
                    <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Other Pages:</h6>
                    <a class="collapse-item" href="404.html">404 Page</a>
                    <a class="collapse-item" href="blank.html">Blank Page</a>
                </div>
            </div>
        </li>


        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="charts.html">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Charts</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="tables.html">
                <i class="fas fa-fw fa-table"></i>
                <span>Tables</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">




    </ul>
    <!-- End of Sidebar -->
