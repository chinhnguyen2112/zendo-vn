<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="robots" content="noindex,nofollow" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    <!-- base:css -->
    <link rel="stylesheet" href="<?= site_main() ?>assets/css/admin/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="<?= site_main() ?>assets/css/admin/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= site_main() ?>assets/css/admin/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/images/favicon.png" />

</head>
<link rel="stylesheet" href="<?= site_main() ?>assets/css/sweetalert.css">
<script src="<?= site_main() ?>assets/js/core/jquery.min.js"></script>
<script src="<?= site_main() ?>assets/js/jquery.validate.min.js"></script>
<script src="<?= site_main() ?>assets/css/admin/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="<?= site_main() ?>assets/css/admin/vendors/chart.js/Chart.min.js"></script>
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="/assets/js/admin/off-canvas.js"></script>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
                <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                    <a class="navbar-brand brand-logo" href="/"><img src="/images/logo.png" alt="logo" /></a>
                    <a class="navbar-brand brand-logo-mini" href="/"><img src="/images/logo.png" alt="logo" /></a>
                    <button class="navbar-toggler navbar-toggler align-self-center btn_menu" type="button" data-toggle="minimize">
                        <span class="typcn typcn-th-menu"></span>
                    </button>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown mr-0">
                        <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
                            <i class="typcn typcn-bell mx-0"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                            <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="typcn typcn-info mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">Application Error</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        Just now
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-warning">
                                        <i class="typcn typcn-cog-outline mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">Settings</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        Private message
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-info">
                                        <i class="typcn typcn-user mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">New user registration</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        2 days ago
                                    </p>
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="typcn typcn-th-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <nav class="navbar-breadcrumb col-xl-12 col-12 d-flex flex-row p-0">

        </nav>
        <div class="container-fluid page-body-wrapper">
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">
                            <i class="typcn typcn-device-desktop menu-icon"></i>
                            <span class="menu-title">Trang chủ</span>
                        </a>
                    </li>
                    <?php if (is_admin_vip()) {  ?>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                                <i class="typcn typcn-document-text menu-icon"></i>
                                <span class="menu-title">Blog</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-basic">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"><a class="nav-link" href="/admin/ds_blog">Danh Sách Bài Viết</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/admin/add_blog">Thêm Bài Viết</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/admin/ds_cate">Danh Sách Chuyên Mục</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/admin/add_cate">Thêm Chuyên Mục</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                                <i class="typcn typcn-film menu-icon"></i>
                                <span class="menu-title">Vòng quay</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="form-elements">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"><a class="nav-link" href="/admin/ls_quay">Lịch sử quay</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/admin/gift">Danh Sách Phần Quà</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/admin/add_gift">Thêm Phần Quà</a></li>
                                    <!-- <li class="nav-item"><a class="nav-link" href="?act=add_discount">Thêm Mã Giảm Giá</a></li>
                                    <li class="nav-item"><a class="nav-link" href="?act=discount">Danh Sách Mã Giảm Giá</a></li> -->
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                                <i class="typcn typcn-user-add-outline menu-icon"></i>
                                <span class="menu-title">Đăng acc</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="auth">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" href="/admin/ds_acc">Danh sách acc</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="/admin/post_lmht">Đăng Acc LMHT</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="/admin/post_lq">Đăng Liên Quân</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="/admin/post_fifa">Đăng FIFA</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="/admin/post_lmtc">Đăng Liên Minh Tốc Chiến</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="/admin/post_freefire">Đăng Free Fire</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="/admin/post_pubg">Đăng Pubg</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="/admin/post_cf">Đăng CF</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="/admin/post_valorant">Đăng Valorant</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="/admin/post_lq_random">Đăng Random Liên Quân</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/ve_so">
                                <i class="typcn typcn-film menu-icon"></i>
                                <span class="menu-title">Vé số</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/game_bq">
                                <i class="typcn typcn-film menu-icon"></i>
                                <span class="menu-title">Game bản quyền</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/traffic">
                                <i class="typcn typcn-film menu-icon"></i>
                                <span class="menu-title">Trafic</span>
                            </a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/member">
                            <i class="typcn typcn-film menu-icon"></i>
                            <span class="menu-title">Thành viên</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basics" aria-expanded="false" aria-controls="ui-basics">
                            <i class="typcn typcn-document-text menu-icon"></i>
                            <span class="menu-title">Giao dịch</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basics">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="/admin/his_acc/">Tài khoản đã bán</a></li>
                                <li class="nav-item"><a class="nav-link" href="/admin/his_card/">Thẻ được nạp</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <?php
                    if (isset($content)) {
                        $this->load->view($content);
                    }
                    ?>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 <a href="https://www.bootstrapdash.com/" class="text-muted" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
                                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">Free <a href="https://www.bootstrapdash.com/" class="text-muted" target="_blank">Bootstrap dashboard</a> templates from Bootstrapdash.com</span>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- base:js -->
    <script src="/assets/js/admin/hoverable-collapse.js"></script>
    <script src="/assets/js/admin/template.js"></script>
    <script src="/assets/js/admin/settings.js"></script>
    <script src="/assets/js/admin/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="/assets/js/admin/dashboard.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <!-- End custom js for this page-->


    <script src="/assets/js/sweetalert.min.js"></script>