<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title?></title>
    <?= csrf_meta() ?>

    <base href="<?php echo base_url('assets') ?>/">
    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('adminLTE'); ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('adminLTE'); ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('adminLTE'); ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="<?= base_url('adminLTE'); ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('adminLTE'); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url('adminLTE'); ?>/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('adminLTE'); ?>/css/adminlte.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('adminLTE'); ?>/plugins/sweetalert2/sweetalert2.min.css">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('adminLTE'); ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('adminLTE'); ?>/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('adminLTE'); ?>/plugins/summernote/summernote-bs4.min.css">
    
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('adminLTE'); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('adminLTE'); ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('adminLTE'); ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    
    <!-- Custom App CSS -->
    <link rel="stylesheet" href="<?= base_url(''); ?>css/app.css">

    <?= $this->renderSection('page_css'); ?>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        
        <?= $this->include('layouts/navbar'); ?>
        <?= $this->include('layouts/sidebar'); ?>

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url('adminLTE'); ?>/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- ## Section -->
        <?= $this->renderSection('content'); ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url('adminLTE'); ?>/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url('adminLTE'); ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('adminLTE'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Select2 -->
    <script src="<?= base_url('adminLTE'); ?>/plugins/select2/js/select2.full.min.js"></script>

    <!-- ChartJS -->
    <script src="<?= base_url('adminLTE'); ?>/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?= base_url('adminLTE'); ?>/plugins/sparklines/sparkline.js"></script>

    <!-- JQVMap -->
    <script src="<?= base_url('adminLTE'); ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?= base_url('adminLTE'); ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    
    <!-- jQuery Knob Chart -->
    <script src="<?= base_url('adminLTE'); ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url('adminLTE'); ?>/plugins/moment/moment.min.js"></script>
    <script src="<?= base_url('adminLTE'); ?>/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url('adminLTE'); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="<?= base_url('adminLTE'); ?>/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url('adminLTE'); ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="<?= base_url('adminLTE'); ?>/plugins/sweetalert2/sweetalert2.min.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="<?= base_url('adminLTE'); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('adminLTE'); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('adminLTE'); ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('adminLTE'); ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url('adminLTE'); ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('adminLTE'); ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url('adminLTE'); ?>/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url('adminLTE'); ?>/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url('adminLTE'); ?>/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url('adminLTE'); ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url('adminLTE'); ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url('adminLTE'); ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    
    <!-- AdminLTE App -->
    <script src="<?= base_url('adminLTE'); ?>/js/adminlte.js"></script>
    
    
    <!-- Custom App JS -->
    <script src="<?= base_url(''); ?>/js/app.js"></script>


    <!-- Page Script | Javascript Khusus di halaman tersebut -->
    <?= $this->renderSection('page_script'); ?>

    <script>
        $(document).ready(function() {
            /*** add active class and stay opened when selected ***/
            var url = window.location;
    
            // for sidebar menu entirely but not cover treeview
            $('ul.nav-sidebar a').filter(function() {
                if (this.href) {
                    return this.href == url || url.href.indexOf(this.href) == 0;
                }
            }).addClass('active');
    
            // for the treeview
            $('ul.nav-treeview a').filter(function() {
                if (this.href) {
                    return this.href == url || url.href.indexOf(this.href) == 0;
                }
            }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
        });


        $('.select2').on('select2:open', function (e) {
            document.querySelector('.select2-search__field').focus();
        });
    </script>
    
</body>

</html>