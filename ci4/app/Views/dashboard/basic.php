<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" sizes="180x180" href="/assets/dist/img/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/assets/dist/img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/assets/dist/img/favicon-16x16.png">

	<title><?php echo isset($title) ? $title : "Aircraft Bidding Application"?></title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
	<!-- daterange picker -->
	<link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="/assets/plugins/jqvmap/jqvmap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	
	<!-- summernote -->
	<link rel="stylesheet" href="/assets/plugins/summernote/summernote-bs4.min.css">

	<link rel="stylesheet" href="/assets/css/style.css">

	
	<script type="text/javascript">
		var base_url = "<?php echo base_url()?>";
	</script>

	<!-- jQuery -->
	<script src="/assets/plugins/jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	$.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- Bootstrap 4 -->
	<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- DataTables  & Plugins -->
	<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<script src="/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
	<script src="/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
	<script src="/assets/plugins/jszip/jszip.min.js"></script>
	<script src="/assets/plugins/pdfmake/pdfmake.min.js"></script>
	<script src="/assets/plugins/pdfmake/vfs_fonts.js"></script>
	<script src="/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
	<script src="/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
	<script src="/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
	<!-- JQVMap -->
	<script src="/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
	<script src="/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
	
	<script src="/assets/plugins/moment/moment.min.js"></script>
	<!-- date-range-picker -->
	<script src="/assets//plugins/daterangepicker/daterangepicker.js"></script>

	<!-- Tempusdominus Bootstrap 4 -->
	<script src="/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

	<!-- Summernote -->
	<script src="/assets/plugins/summernote/summernote-bs4.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- AdminLTE App -->
	<script src="/assets/dist/js/adminlte.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<!-- Preloader -->
		<div class="preloader flex-column justify-content-center align-items-center">
			<img class="animation__shake" src="/assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
		</div>

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
			</ul>

			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<!-- Notifications Dropdown Menu -->
				<li class="nav-item dropdown">
				<a class="nav-link" data-toggle="dropdown" href="#">
					<?php echo isset($_SESSION['user']) ? $_SESSION['user']->username : ''?> &nbsp;&nbsp;
					<i class="fas fa-user"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<a href="<?= base_url() ?>/logout" class="dropdown-item dropdown-footer">Log out</a>
				</div>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="<?= base_url('/') ?>" class="brand-link">
				<span class="brand-text font-weight-light">Aircraft Bidding Application</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar Menu -->
				<nav class="mt-2">
				<?php 				
                include('nav.php');
				?>
					
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<?php
			if(isset($sub_page)) {
				include('subpages/'.$sub_page.'.php');
			}
			
			?>
		</div>
		<!-- /.content-wrapper -->

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
		<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->
</body>
</html>