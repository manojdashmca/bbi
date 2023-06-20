<!doctype html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <title>Dashboard | BBI</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Webapplication of SSK Bharat BBI" name="description" />
        <meta content="SSK Bharat BBI" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?= CUSTOMPATH ?>panelassets/images/logobbi.png">

        <!-- plugin css -->
        <link href="<?= CUSTOMPATH ?>panelassets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- preloader css -->
        <link rel="stylesheet" href="<?= CUSTOMPATH ?>panelassets/css/preloader.min.css" type="text/css" />
        <!-- Bootstrap Css -->
        <link href="<?= CUSTOMPATH ?>panelassets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?= CUSTOMPATH ?>panelassets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= CUSTOMPATH ?>panelassets/css/custom.css" id="app-style" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <?php
        require_once __DIR__ . '/managedCss.php';
        ?>
        <link href="<?= CUSTOMPATH ?>panelassets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>
    <body>
        <!-- <body data-layout="horizontal"> -->
        <!-- Begin page -->
        <div id="layout-wrapper">            
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="<?= ADMINPATH ?>" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="/panelassets/images/logobbi.png" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="/panelassets/images/logobbi.png" alt="" height="60">
                                </span>
                            </a>

                            <a href="<?=ADMINPATH?>" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="/panelassets/images/logobbi.png" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="/panelassets/images/logobbi.png" alt="" height="60">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                    </div>

                    <div class="d-flex">
                        <div class="dropdown d-none d-sm-inline-block">
                            <button type="button" class="btn header-item" id="mode-setting-btn">
                                <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                                <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                            </button>
                        </div>                        

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="bell" class="icon-lg"></i>
                                <span class="badge bg-danger rounded-pill">5</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                 aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0"> Notifications </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#!" class="small text-reset text-decoration-underline"> Unread (3)</a>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="/panelassets/images/users/avatar-3.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">James Lemire</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">It will seem like simplified English.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1 hour ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-sm me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="bx bx-cart"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Your order is placed</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3 min ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-sm me-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="bx bx-badge-check"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Your item is shipped</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3 min ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="/panelassets/images/users/avatar-6.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Salena Layfield</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1 hour ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2 border-top d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                        <i class="mdi mdi-arrow-right-circle me-1"></i> <span>View More..</span> 
                                    </a>
                                </div>
                            </div>
                        </div>                        

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="<?=session()->get('img')?>"
                                     alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium"><?=session()->get('username')?></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
<!--                                <a class="dropdown-item" href="<?= ADMINPATH ?>profile"><i class="mdi mdi-face-man-profile font-size-16 align-middle me-1"></i> Profile</a>
                                <div class="dropdown-divider"></div>-->
                                <a class="dropdown-item" href="<?= ADMINPATH ?>logout"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                            </div>
                        </div>

                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <?php require_once __DIR__ . '/menubar.php'; ?>
                </div>
            </div>
            <!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">