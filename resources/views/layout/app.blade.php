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

    <!-- Choices JS -->
    <script src="/assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

    <!-- Main Theme Js -->
    <script src="/assets/js/main.js"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" >

    <!-- Style Css -->
    <link href="/assets/css/styles.min.css" rel="stylesheet" >

    <!-- Icons Css -->
    <link href="/assets/css/icons.css" rel="stylesheet" >

    <!-- Node Waves Css -->
    <link href="/assets/libs/node-waves/waves.min.css" rel="stylesheet" >

    <!-- Simplebar Css -->
    <link href="/assets/libs/simplebar/simplebar.min.css" rel="stylesheet" >

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="/assets/libs/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" href="/assets/libs/@simonwep/pickr/themes/nano.min.css">

    <!-- Choices Css -->
    <link rel="stylesheet" href="/assets/libs/choices.js/public/assets/styles/choices.min.css">

    <link rel="stylesheet" href="../assets/libs/sweetalert2/sweetalert2.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>


<!-- Loader -->
<div id="loader" >
    <img src="/assets/images/media/loader.svg" alt="">
</div>
<!-- Loader -->

<div class="page">
    <!-- app-header -->
    <header class="app-header">

        <!-- Start::main-header-container -->
        <div class="main-header-container container-fluid ">

            <!-- Start::header-content-left -->
            <div class="header-content-left">

                <!-- Start::header-element -->
                <div class="header-element">
                    <div class="horizontal-logo">
                        <a href="{{url('/')}}" class="header-logo">
                            <img src="/assets/images/logo.png" alt="logo" class="desktop-logo">
                            <img src="/assets/images/logo.png"  alt="logo" class="toggle-logo">
                            <img src="/assets/images/logo.png"  alt="logo" class="desktop-dark">
                            <img src="/assets/images/logo.png" alt="logo" class="toggle-dark">
                            <img src="/assets/images/logo.png"  alt="logo" class="desktop-white">
                            <img src="/assets/images/logo.png"  alt="logo" class="toggle-white">
                        </a>
                    </div>
                </div>
                <!-- End::header-element -->

                <!-- Start::header-element -->
                <div class="header-element">
                    <!-- Start::header-link -->
                    <a aria-label="Hide Sidebar" class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle" data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
                    <!-- End::header-link -->
                </div>
                <!-- End::header-element -->



            </div>
            <!-- End::header-content-left -->

            <!-- Start::header-content-right -->
            <div class="header-content-right">



                <!-- Start::header-element -->
                <div class="header-element main-profile-user">
                    <!-- Start::header-link|dropdown-toggle -->
                    <a href="#" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <div class="me-xxl-2 me-0">
                                <img src="https://ui-avatars.com/api/?name={{\Illuminate\Support\Facades\Auth::user()->name}}" alt="img" width="32" height="32" class="rounded-circle">
                            </div>
                            <div class="d-xxl-block d-none my-auto">
                                <h6 class="fw-semibold mb-0 lh-1 fs-14">{{\Illuminate\Support\Facades\Auth::user()->name}}</h6>
                                <span class="op-7 fw-normal d-block fs-11 text-muted">{{\Illuminate\Support\Facades\Auth::user()->super_admin?"Super Admin":"Admin"}}</span>
                            </div>
                        </div>
                    </a>
                    <!-- End::header-link|dropdown-toggle -->
                    <ul class="main-header-dropdown dropdown-menu pt-0 header-profile-dropdown dropdown-menu-end" aria-labelledby="mainHeaderProfile">
                        <li class="drop-heading d-xxl-none d-block">
                            <div class="text-center">
                                <h5 class="text-dark mb-0 fs-14 fw-semibold">Json Taylor</h5>
                                <small class="text-muted">Web Designer</small>
                            </div>
                        </li>
                        <li class="dropdown-item"><a class="d-flex w-100" href="profile.html"><i class="fe fe-user fs-18 me-2 text-primary"></i>Profile</a></li>
                        <li class="dropdown-item"><a class="d-flex w-100" href="mail.html"><i class="fe fe-mail fs-18 me-2 text-primary"></i>Inbox <span class="badge bg-danger ms-auto">25</span></a></li>
                        <li class="dropdown-item"><a class="d-flex w-100" href="mail-settings.html"><i class="fe fe-settings fs-18 me-2 text-primary"></i>Settings</a></li>
                        <li class="dropdown-item"><a class="d-flex w-100" href="chat.html"><i class="fe fe-headphones fs-18 me-2 text-primary"></i>Support</a></li>
                        <li class="dropdown-item"><a class="d-flex w-100" href="lockscreen.html"><i class="fe fe-lock fs-18 me-2 text-primary"></i>Lockscreen</a></li>
                        <li class="dropdown-item"><a class="d-flex w-100" href="sign-in.html"><i class="fe fe-info fs-18 me-2 text-primary"></i>Log Out</a></li>
                    </ul>
                </div>
                <!-- End::header-element -->



            </div>
            <!-- End::header-content-right -->

        </div>
        <!-- End::main-header-container -->

    </header>
    <!-- /app-header -->
    <!-- Start::app-sidebar -->
    <aside class="app-sidebar sticky" id="sidebar">

        <!-- Start::main-sidebar-header -->
        <div class="main-sidebar-header" style="position:relative;">
            <a href="{{url('/')}}" class="header-logo">
                <img src="/assets/images/logo.png" width="150" alt="logo" class="desktop-logo">
                <img src="/assets/images/logo.png" width="150" alt="logo" class="toggle-logo">
                <img src="/assets/images/logo.png" width="150" alt="logo" class="desktop-dark">
                <img src="/assets/images/logo.png" width="150" alt="logo" class="toggle-dark">
                <img src="/assets/images/logo.png" width="150" alt="logo" class="desktop-white">
                <img src="/assets/images/logo.png" width="150" alt="logo" class="toggle-white">
            </a>
        </div>
        <!-- End::main-sidebar-header -->

        <!-- Start::main-sidebar -->
        <div class="main-sidebar" id="sidebar-scroll" style="margin-block-start:0;">

            <!-- Start::nav -->
            <nav class="main-menu-container nav nav-pills flex-column sub-open">
                <div class="slide-left" id="slide-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
                </div>
                <ul class="main-menu">
                    <!-- Start::slide -->
                    <li class="slide">
                        <a href="{{route('home')}}" class="side-menu__item">
                            <i class="fe fe-home side-menu__icon"></i>
                            <span class="side-menu__label">Dashboard</span>
                        </a>
                    </li>
                    <!-- End::slide -->

                    <!-- Start::slide -->
                    <li class="slide">
                        <a href="{{route('users.index')}}" class="side-menu__item">
                            <i class="fe fe-users side-menu__icon"></i>
                            <span class="side-menu__label">Manage Users</span>
                        </a>
                    </li>
                    <!-- End::slide -->

                    <!-- Start::slide -->
                    <li class="slide">
                        <a href="{{route('ride-requests.index')}}" class="side-menu__item">
                            <i class="fe fe-map-pin side-menu__icon"></i>
                            <span class="side-menu__label">Ride Request</span>
                        </a>
                    </li>
                    <!-- End::slide -->

                    <!-- Start::slide -->
                    <li class="slide">
                        <a href="{{route('sos-list.index')}}" class="side-menu__item">
                            <i class="fe fe-alert-triangle side-menu__icon"></i>
                            <span class="side-menu__label">SOS List</span>
                        </a>
                    </li>
                    <!-- End::slide -->
                    @if(\Illuminate\Support\Facades\Auth::user()->super_admin)
                    <!-- Start::slide -->
                    <li class="slide">
                        <a href="{{route('admins.index')}}" class="side-menu__item">
                            <i class="fe fe-user side-menu__icon"></i>
                            <span class="side-menu__label">Manage Admin</span>
                        </a>
                    </li>
                    <!-- End::slide -->
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->super_admin)
                    <!-- Start::slide -->
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <i class="fe fe-grid side-menu__icon"></i>
                                <span class="side-menu__label">Setting</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0)">Setting</a>
                                </li>
                                <li class="slide">
                                    <a href="{{route('faqs.index')}}" class="side-menu__item">FAQ's</a>
                                </li>
                                <li class="slide">
                                    <a href="{{route('settings.getAboutUs')}}" class="side-menu__item">About Us</a>
                                </li>
                                <li class="slide">
                                    <a href="{{route('settings.getTermsCondition')}}" class="side-menu__item">Terms Condition</a>
                                </li>
                                <li class="slide">
                                    <a href="{{route('settings.getPrivacyPolicy')}}" class="side-menu__item">Privacy Policy</a>
                                </li>
                            </ul>
                        </li>
                    <!-- End::slide -->
                    @endif

                    <!-- Start::slide -->
                    <li class="slide">
                        <form method="post" action="{{route('logout')}}" id="LogoutForm">
                            @csrf
                        </form>

                        <a href="javascript:void(0)" class="side-menu__item" onclick="document.getElementById('LogoutForm').submit()">
                        <i class="fe fe-info side-menu__icon"></i>
                            <span class="side-menu__label">Logout</span>
                        </a>
                    </li>
                    <!-- End::slide -->




                </ul>
                <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
            </nav>
            <!-- End::nav -->

        </div>
        <!-- End::main-sidebar -->

    </aside>
    <!-- End::app-sidebar -->

    @yield('content')


   <!-- Footer Start -->
<footer class="footer mt-auto py-3 text-center">
    <div class="container">
        <span class="">
            Copyright © <span id="year">{{now()->year}}</span>
            <a href="{{url('/')}}" class="text-primary">Driver Drowsiness Detection System</a>.
            All rights reserved
            <div class="social-icons d-inline mt-3">
                <!-- Facebook Icon -->
                <a href="https://www.facebook.com/your-page" class="text-primary mx-2" target="_blank" aria-label="Facebook">
                    <i class="fe fe-facebook" style="font-size: 22px;"></i>
                </a>
                <!-- Instagram Icon -->
                <a href="https://www.instagram.com/your-profile" class="text-danger mx-2" target="_blank" aria-label="Instagram">
                    <i class="fe fe-instagram"  style="font-size: 22px;"></i>
                </a>
                <!-- LinkedIn Icon -->
                <a href="https://www.linkedin.com/in/your-profile" class="text-secondary mx-2" target="_blank" aria-label="LinkedIn">
                    <i class="fe fe-linkedin" style="font-size: 22px;"></i>
                </a>
            </div>
        </span>
    </div>
</footer>

</div>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>


<!-- Scroll To Top -->
<div class="scrollToTop">
    <span class="arrow"><i class="ri-arrow-up-s-fill fs-20"></i></span>
</div>
<div id="responsive-overlay"></div>
<!-- Scroll To Top -->


<div class="modal fade" id="editModalGetAjax"
     aria-labelledby="editModalGetAjax" data-bs-keyboard="false"
     aria-hidden="true">
    <!-- Scrollable modal -->
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        </div>
    </div>
</div>

<!-- Popper JS -->
<script src="/assets/libs/@popperjs/core/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Defaultmenu JS -->
<script src="/assets/js/defaultmenu.min.js"></script>

<!-- Node Waves JS-->
<script src="/assets/libs/node-waves/waves.min.js"></script>

<!-- Sticky JS -->
<script src="/assets/js/sticky.js"></script>

<!-- Simplebar JS -->
<script src="/assets/libs/simplebar/simplebar.min.js"></script>
<script src="/assets/js/simplebar.js"></script>

<!-- Color Picker JS -->
<script src="/assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>
<!-- Sweetalerts JS -->
<script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>

<link rel="stylesheet" type="text/css" href="/assets/css/responsive.dataTables.min.css">
<script src="/assets/js/dataTables.responsive.js" defer></script>



@stack('scripts')

<script>
    $(function (){
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };



        @if(session()->has('message'))
            toastr["success"]("{{ session()->get('message') }}")
        @endif

        @if($errors->any())
            toastr["danger"]("{{ $errors->first() }}")
        @endif

        $('body').delegate('.delete-confirm','click',function (){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent('form').submit();
                    }
                })
        });


        $('body').delegate('.edit-model','click',function (){
            let url=$(this).attr('data-href');
            $.ajax({
                url: url,
                success: function(result){
                    $("#editModalGetAjax").find('.modal-content').html(result);
                    $("#editModalGetAjax").modal('toggle');
                }
            });


        });


        $('body').delegate('.add-model','click',function (){
            let url=$(this).attr('data-href');
            $.ajax({
                url: url,
                success: function(result){
                    $("#editModalGetAjax").find('.modal-content').html(result);
                    $("#editModalGetAjax").modal('toggle');
                }
            });


        });

    })
</script>


</body>

</html>
