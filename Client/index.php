<?php
    include "functions/authenticate.php";
    include "functions/function.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    
    <title>Parkir</title>
</head>
<body>
    <!-- ///////////////////////////// Body //////////////////////////////////////////////// -->
    <div class="container-scroller">
        <!-- ///////////////////////////// Sidebar //////////////////////////////////////////////// -->
        <?php include "templates/_sidebar.php"?>
        <!-- ///////////////////////////// End Sidebar //////////////////////////////////////////////// -->

        <div class="container-fluid page-body-wrapper">

            <!-- ///////////////////////////// Navbar //////////////////////////////////////////////// -->
            <?php include "templates/_navbar.php"?>
            <!-- ///////////////////////////// Navbar //////////////////////////////////////////////// -->
            <div class="main-panel">
                <!-- ///////////////////////////// Page Content //////////////////////////////////////////////// -->
                <div class="content-wrapper mb-3">
                    <?php 
                        if(isset($_GET['page'])){
                            $page = $_GET['page'];
                    
                            switch ($page) {
                                case 'dashboard':
                                    include "pages/dashboard.php";
                                break;
                                case 'parkir':
                                    include "pages/DataTransaksi/parkir.php";
                                    break;
                                case 'parkirMasuk':
                                        include "pages/DataTransaksi/parkir-masuk.php";
                                    break; 
                                case 'parkir-keluar':
                                    include "pages/DataTransaksi/parkir-keluar.php";
                                break;
                                case 'hstparkir':
                                        include "pages/DataTransaksi/history-parkir.php";
                                    break;
                                case 'dataUser':
                                    include "pages/DataMaster/dataUser.php";
                                break;
                                case 'tambahUser':
                                    include "pages/DataMaster/tambahUser.php";
                                break;
                                case 'editUser':
                                    include "pages/DataMaster/editUser.php";
                                break;
                                case 'hapusUser':
                                    include "pages/DataMaster/hapusUser.php";
                                break;
                                case 'jenisKendaraan':
                                    include "pages/DataMaster/jenisKendaraan.php";
                                break; 
                                case 'tambahjeniskd':
                                    include "pages/DataMaster/tambahJenisKendaraan.php";
                                break; 
                                case 'editJenisKendaraan':
                                    include "pages/DataMaster/editJenisKendaraan.php";
                                break;
                                case 'hapusJenisKendaraan':
                                    include "pages/DataMaster/hapusJenisKendaraan.php";
                                break;
                                case 'tempatParkir':
                                    include "pages/DataMaster/tempatParkir.php";
                                break;
                                case 'tambahTempatParkir':
                                    include "pages/DataMaster/tambahTempatParkir.php";
                                break;
                            }
                        }else{
                            include "pages/dashboard.php";
                        }
                    ?>
                </div>
                <!-- ///////////////////////////// End Page Content //////////////////////////////////////////////// -->

                <!-- ///////////////////////////// Footer //////////////////////////////////////////////// -->
                <?php include "templates/_footer.php"?>
                <!-- ///////////////////////////// Footer //////////////////////////////////////////////// -->
            </div>
        </div>
    </div>
    <!-- ///////////////////////////// End Body //////////////////////////////////////////////// -->


    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
    <!-- Chart -->
    <script src="assets/js/chart.js"></script>
    <!-- End Chart -->
    <!-- Custom js for this page -->
    <script src="assets/vendors/select2/select2.min.js"></script>
    <script src="assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/js/select2.js"></script>
    <!-- End custom js for this page -->

</body>
</html>