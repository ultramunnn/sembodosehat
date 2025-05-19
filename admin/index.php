<?php
include_once __DIR__ . '/../includes/app_admin.php';


?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../assets/img/logo.png" alt="AdminLTELogo" height="60" width="60">
        </div>
        <?php
        // Tangkap output dashboard.php ke variabel $content
        ob_start();
        include __DIR__ . '/../includes/dashboard.php';
        $content = ob_get_clean();
        ?>


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


</body>

</html>