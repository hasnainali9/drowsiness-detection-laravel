<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @yield('title') – Driver Drowsiness Detection </title>
    <meta name="Description" content="Driver Drowsiness Detection">
    <meta name="Author" content="Riphah International University">
    <meta name="keywords" content="Driver Drowsiness Detection Riphah International University">

    <!-- Favicon -->
    <link rel="icon" href="/assets/images/brand-logos/favicon.ico" type="image/x-icon">
    <!-- Main Theme Js -->
    <script src="/assets/js/authentication-main.js"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" >

    <!-- Style Css -->
    <link href="/assets/css/styles.min.css" rel="stylesheet" >

    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" >


</head>

<body>



<!-- Loader -->
<div id="loader" >
    <img src="../assets/images/media/loader.svg" alt="">
</div>
<!-- Loader -->

@yield('content')
<!-- Bootstrap JS -->
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Show Password JS -->
<script src="/assets/js/show-password.js"></script>

</body>

</html>
