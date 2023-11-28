<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
	<meta name="googlebot" content="noindex">
	<meta name="robots" content="noindex">
	<meta name="googlebot" content="noindex">
    <title>Thriftex - Admin</title>
    <link href="<?= get_template_directory_asst('','assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i&display=swap" rel="stylesheet">
    <link href="<?= get_template_directory_asst('','assets/css/style.css') ?>" rel="stylesheet">
</head>
<body>
    <header class="navbar navbar-expand-lg sticky-top navbar-light bg-white shadow-sm p-3">
        <div class="container-xxl flex-wrap flex-lg-nowrap">
        <img src="<?= base_url('assets/img/logo.png') ?>" class="me-3" style="width: 130px;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="http://localhost:8000/dibio/admin">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Harga</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">FAQ</a>
                    </li> -->
                </ul>
                <a href="<?= base_url('logout') ?>" class="btn btn-dark rounded-0">Logout</a>
            </div>
        </div>
    </header>