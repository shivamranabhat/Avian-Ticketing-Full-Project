<!DOCTYPE html><!-- saved from url=(0014)about:internet -->
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="light" data-toggled="close">

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Avian | Dashboard</title>

    <!-- Choices JS -->
    <script src="{{asset('assets/libs/choices.js/public/assets/scripts/choices.min.js')}}"></script>
    <!-- Main Theme Js -->
    <script src="{{asset('assets/js/main.js')}}"></script> <!-- Bootstrap Css -->
    <link id="style" href="{{asset('assets/libs/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Style Css -->
    <link href="{{asset('assets/css/styles.min.css')}}" rel="stylesheet"> <!-- Icons Css -->
    <link href="{{asset('assets/css/flash.css')}}?v={{time()}}" rel="stylesheet"> <!-- Flash Css -->
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet"> <!-- Node Waves Css -->
    <link href="{{asset('assets/libs/node-waves/waves.min.css')}}" rel="stylesheet"> <!-- Simplebar Css -->
    <link href="{{asset('assets/libs/simplebar/simplebar.min.css')}}" rel="stylesheet"> <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/libs/@simonwep/pickr/themes/nano.min.css')}}"> <!-- Choices Css -->
    <link rel="stylesheet" href="{{asset('assets/libs/choices.js/public/assets/styles/choices.min.css')}}">

    <!--[if gte IE 5]><frame></frame><![endif]-->
</head>

<body>

    <div class="page">
        <!-- app-header -->
        <header class="app-header">
            <!-- Start::main-header-container -->
            <div class="main-header-container container-fluid">
                <!-- Start::header-content-left -->
                <div class="header-content-left">
                    <!-- Start::header-element -->
                    <div class="header-element">
                        <div class="horizontal-logo">
                            <h5>Avian</h5>
                        </div>
                    </div> <!-- End::header-element -->
                    <!-- Start::header-element -->
                    <div class="header-element">
                        <!-- Start::header-link --> <a aria-label="Hide Sidebar"
                            class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle"
                            data-bs-toggle="sidebar" href="javascript:void(0);"> <i
                                class="header-icon fe fe-align-left"></i> </a>
                        <div class="main-header-center d-none d-lg-block"> <input class="form-control"
                                placeholder="Search for anything..." type="search"> <button class="btn"><i
                                    class="fa fa-search d-none d-md-block"></i></button> </div>
                        <!-- End::header-link -->
                    </div> <!-- End::header-element -->
                </div> <!-- End::header-content-left -->
                <!-- Start::header-content-right -->
                <div class="header-content-right">
                    <div class="header-element Search-element d-block d-lg-none">
                        <!-- Start::header-link|dropdown-toggle --> <a href="javascript:void(0);"
                            class="header-link dropdown-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="header-link-icon">
                                <path
                                    d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z">
                                </path>
                            </svg> </a> <!-- End::header-link|dropdown-toggle -->
                        <ul class="main-header-dropdown dropdown-menu dropdown-menu-end Search-element-dropdown"
                            data-popper-placement="none">
                            <li>
                                <div class="input-group w-100 p-2"> <input type="text" class="form-control"
                                        placeholder="Search....">
                                    <div class="btn btn-primary"> <i class="fa fa-search" aria-hidden="true"></i> </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- Start::header-element -->
                    <div class="header-element messages-dropdown">
                        <!-- Start::header-link|dropdown-toggle --> <a href="javascript:void(0);"
                            class="header-link dropdown-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon" height="24px"
                                viewBox="0 0 24 24" width="24px" fill="currentColor">
                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                <path
                                    d="M22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6zm-2 0l-8 5-8-5h16zm0 12H4V8l8 5 8-5v10z">
                                </path>
                            </svg> <span class="pulse-danger"></span> </a> <!-- End::header-link|dropdown-toggle -->
                        <!-- Start::main-header-dropdown -->
                        <div class="main-header-dropdown dropdown-menu dropdown-menu-end main-header-message"
                            data-popper-placement="none">
                            <div class="menu-header-content bg-primary text-fixed-white">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0 fs-15 fw-semibold text-fixed-white">Messages</h6> <span
                                        class="badge rounded-pill bg-warning pt-1 text-fixed-black">Mark All Read</span>
                                </div>
                                <p class="dropdown-title-text subtext mb-0 text-fixed-white op-6 pb-0 fs-12 ">You have 4
                                    unread messages</p>
                            </div>
                            <div>
                                <hr class="dropdown-divider">
                            </div>
                            <ul class="list-unstyled mb-0" id="header-cart-items-scroll" data-simplebar="init">
                                <div class="simplebar-wrapper" style="margin: 0px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                aria-label="scrollable content" style="height: auto; overflow: hidden;">
                                                <div class="simplebar-content" style="padding: 0px;">
                                                    <li class="dropdown-item">
                                                        <div class="d-flex messages"> <span
                                                                class="avatar avatar-md me-2 online avatar-rounded flex-shrink-0">
                                                                <img src="#" alt="img">
                                                            </span>
                                                            <div>
                                                                <div class="d-flex"> <a href="chat.html">
                                                                        <h6 class="mb-1 name">Petey Cruiser</h6>
                                                                    </a> </div>
                                                                <p class="mb-0 fs-12 desc">I'm sorry but i'm not sure
                                                                    how to help you with that......</p>
                                                                <p class="time mb-0 text-start float-start ms-2 mt-2">
                                                                    Mar 15 3:55 PM</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <div class="d-flex messages"> <span
                                                                class="avatar avatar-md me-2 online avatar-rounded flex-shrink-0">
                                                                <img src="#" alt="img">
                                                            </span>
                                                            <div>
                                                                <div class="d-flex"> <a href="chat.html">
                                                                        <h6 class="mb-1 name">Jimmy Changa</h6>
                                                                    </a> </div>
                                                                <p class="mb-0 fs-12 desc">All set ! Now, time to get to
                                                                    you now......</p>
                                                                <p class="time mb-0 text-start float-start ms-2 mt-2">
                                                                    Mar 06 01:12 AM</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <div class="d-flex messages"> <span
                                                                class="avatar avatar-md me-2 online avatar-rounded flex-shrink-0">
                                                                <img src=".#" alt="img">
                                                            </span>
                                                            <div>
                                                                <div class="d-flex"> <a href="chat.html">
                                                                        <h6 class="mb-1 name">Graham Cracker</h6>
                                                                    </a> </div>
                                                                <p class="mb-0 fs-12 desc">Are you ready to pickup your
                                                                    Delivery...</p>
                                                                <p class="time mb-0 text-start float-start ms-2 mt-2">
                                                                    Feb 25 10:35 AM</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <div class="d-flex messages"> <span
                                                                class="avatar avatar-md me-2 online avatar-rounded flex-shrink-0">
                                                                <img src="#" alt="img">
                                                            </span>
                                                            <div>
                                                                <div class="d-flex"> <a href="chat.html">
                                                                        <h6 class="mb-1 name">Donatella Nobatti</h6>
                                                                    </a> </div>
                                                                <p class="mb-0 fs-12 desc">Here are some products ...
                                                                </p>
                                                                <p class="time mb-0 text-start float-start ms-2 mt-2">
                                                                    Feb 12 05:12 PM</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <div class="d-flex messages"> <span
                                                                class="avatar avatar-md me-2 online avatar-rounded flex-shrink-0">
                                                                <img src="#" alt="img">
                                                            </span>
                                                            <div>
                                                                <div class="d-flex"> <a href="chat.html">
                                                                        <h6 class="mb-1 name">Anne Fibbiyon</h6>
                                                                    </a> </div>
                                                                <p class="mb-0 fs-12 desc">I'm sorry but i'm not sure
                                                                    how...</p>
                                                                <p class="time mb-0 text-start float-start ms-2 mt-2">
                                                                    Jan 29 03:16 PM</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                                </div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                                </div>
                            </ul>
                            <div class="text-center dropdown-footer"> <a href="chat.html"
                                    class="text-primary fs-13">VIEW ALL</a> </div>
                        </div> <!-- End::main-header-dropdown -->
                    </div> <!-- End::header-element -->
                    <!-- Start::header-element -->
                    <div class="header-element notifications-dropdown main-header-notification">
                        <!-- Start::header-link|dropdown-toggle --> <a href="javascript:void(0);"
                            class="header-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                            id="messageDropdown" aria-expanded="false"> <svg xmlns="http://www.w3.org/2000/svg"
                                class="header-link-icon" height="24px" viewBox="0 0 24 24" width="24px"
                                fill="currentColor">
                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                <path
                                    d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z">
                                </path>
                            </svg> <span class="pulse-success"></span> </a> <!-- End::header-link|dropdown-toggle -->
                        <!-- Start::main-header-dropdown -->
                        <div class="main-header-dropdown dropdown-menu dropdown-menu-end main-header-message"
                            data-popper-placement="none">
                            <div class="menu-header-content bg-primary text-fixed-white">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0 fs-15 fw-semibold text-fixed-white">Notifications</h6> <span
                                        class="badge rounded-pill bg-warning pt-1 text-fixed-black">Mark All Read</span>
                                </div>
                                <p class="dropdown-title-text subtext mb-0 text-fixed-white op-6 pb-0 fs-12 ">You have 4
                                    unread Notifications</p>
                            </div>
                            <div>
                                <hr class="dropdown-divider">
                            </div>
                            <ul class="list-unstyled mb-0" id="header-notification-scroll" data-simplebar="init">
                                <div class="simplebar-wrapper" style="margin: 0px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                aria-label="scrollable content" style="height: auto; overflow: hidden;">
                                                <div class="simplebar-content" style="padding: 0px;">
                                                    <li class="dropdown-item px-3">
                                                        <div class="d-flex"> <span
                                                                class="avatar avatar-md me-2 avatar-rounded flex-shrink-0 bg-pink">
                                                                <i class="la la-file-alt fs-20"></i> </span>
                                                            <div class="ms-3"> <a href="mail.html">
                                                                    <h5 class="notification-label text-dark mb-1">New
                                                                        files available</h5>
                                                                </a>
                                                                <div class="notification-subtext">10 hour ago</div>
                                                            </div>
                                                            <div class="ms-auto"> <a href="mail.html"><i
                                                                        class="las la-angle-right text-end text-muted icon"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item px-3">
                                                        <div class="d-flex"> <span
                                                                class="avatar avatar-md me-2 avatar-rounded flex-shrink-0 bg-purple">
                                                                <i class="la la-gem fs-20"></i> </span>
                                                            <div class="ms-3"> <a href="mail.html">
                                                                    <h5 class="notification-label text-dark mb-1">
                                                                        Updates Available</h5>
                                                                </a>
                                                                <div class="notification-subtext">2 days ago</div>
                                                            </div>
                                                            <div class="ms-auto"> <a href="mail.html"><i
                                                                        class="las la-angle-right text-end text-muted icon"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item px-3">
                                                        <div class="d-flex"> <span
                                                                class="avatar avatar-md me-2 avatar-rounded flex-shrink-0 bg-success">
                                                                <i class="la la-shopping-basket fs-20"></i> </span>
                                                            <div class="ms-3"> <a href="mail.html">
                                                                    <h5 class="notification-label text-dark mb-1">New
                                                                        Order Received</h5>
                                                                </a>
                                                                <div class="notification-subtext">1 hour ago</div>
                                                            </div>
                                                            <div class="ms-auto"> <a href="mail.html"><i
                                                                        class="las la-angle-right text-end text-muted icon"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item px-3">
                                                        <div class="d-flex"> <span
                                                                class="avatar avatar-md me-2 avatar-rounded flex-shrink-0 bg-warning">
                                                                <i
                                                                    class="la la-envelope-open fs-20 text-fixed-white"></i>
                                                            </span>
                                                            <div class="ms-3"> <a href="mail.html">
                                                                    <h5 class="notification-label text-dark mb-1">New
                                                                        review received</h5>
                                                                </a>
                                                                <div class="notification-subtext">1 day ago</div>
                                                            </div>
                                                            <div class="ms-auto"> <a href="mail.html"><i
                                                                        class="las la-angle-right text-end text-muted icon"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item px-3">
                                                        <div class="d-flex"> <span
                                                                class="avatar avatar-md me-2 avatar-rounded flex-shrink-0 bg-danger">
                                                                <i class="la la-user-check fs-20"></i> </span>
                                                            <div class="ms-3"> <a href="mail.html">
                                                                    <h5 class="notification-label text-dark mb-1">22
                                                                        verified registrations</h5>
                                                                </a>
                                                                <div class="notification-subtext">2 hour ago</div>
                                                            </div>
                                                            <div class="ms-auto"> <a href="mail.html"><i
                                                                        class="las la-angle-right text-end text-muted icon"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item px-3">
                                                        <div class="d-flex"> <span
                                                                class="avatar avatar-md me-2 avatar-rounded flex-shrink-0 bg-primary">
                                                                <i class="la la-check-circle fs-20"></i> </span>
                                                            <div class="ms-3"> <a href="mail.html">
                                                                    <h5 class="notification-label text-dark mb-1">
                                                                        Project has been approved</h5>
                                                                </a>
                                                                <div class="notification-subtext">4 hour ago</div>
                                                            </div>
                                                            <div class="ms-auto"> <a href="mail.html"><i
                                                                        class="las la-angle-right text-end text-muted icon"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                                </div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                                </div>
                            </ul>
                            <div class="text-center dropdown-footer"> <a href="mail.html"
                                    class="text-primary fs-13">VIEW ALL</a> </div>
                        </div> <!-- End::main-header-dropdown -->
                    </div> <!-- End::header-element -->


                    <!-- Start::header-element -->
                    <div class="header-element headerProfile-dropdown">
                        <!-- Start::header-link|dropdown-toggle --> <a href="javascript:void(0);"
                            class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" aria-expanded="false"> <img
                                src="{{asset('assets/images/profile.png')}}" alt="img" width="37" height="37"
                                class="rounded-circle"> </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <ul class="main-header-dropdown dropdown-menu pt-0 header-profile-dropdown dropdown-menu-end main-profile-menu"
                            aria-labelledby="mainHeaderProfile">
                            <li>
                                <div class="main-header-profile bg-primary menu-header-content text-fixed-white">
                                    <div class="my-auto">
                                        {{-- <h6 class="mb-0 lh-1 text-fixed-white">{{auth()->user() ?
                                            auth()->user()->name :
                                            ''}}</h6><span class="fs-11 op-7 lh-1">
                                            @if(auth()->user() && auth()->user()->roles->first())
                                            {{ auth()->user()->roles->first()->name}}
                                            @elseif(auth()->user()->type == 'Company') Company
                                            @else User @endif
                                        </span> --}}
                                    </div>
                                </div>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center" href="profile.html"><i
                                        class="bi bi-person fs-18 me-2 op-7"></i>Profile</a></li>

                            <li><a class="dropdown-item d-flex align-items-center border-block-end" href="mail.html"><i
                                        class="bi bi-chat-left fs-18 me-2 op-7"></i>Logs</a></li>
                            <livewire:admin.logout />
                            {{--
                            <livewire:auth.signout /> --}}
                        </ul>
                    </div> <!-- End::header-element -->

                </div> <!-- End::header-content-right -->
            </div> <!-- End::main-header-container -->
        </header> <!-- /app-header -->


        <!-- Start::app-sidebar -->
        <aside class="app-sidebar sticky" id="sidebar">
            <!-- Start::main-sidebar-header -->
            <div class="main-sidebar-header d-flex align-items-center justify-content-between">
                <h5>Avian</h5>
            </div>
            <!-- End::main-sidebar-header -->
            <!-- Start::main-sidebar -->
            <div class="main-sidebar" id="sidebar-scroll" data-simplebar="init">
                <div class="simplebar-wrapper" style="margin: -8px 0px -80px;">
                    <div class="simplebar-height-auto-observer-wrapper">
                        <div class="simplebar-height-auto-observer"></div>
                    </div>
                    <div class="simplebar-mask">
                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                                <div class="simplebar-content" style="padding: 8px 0px 80px;">
                                    <!-- Start::nav -->
                                    <nav class="main-menu-container nav nav-pills flex-column sub-open active">
                                        <div class="slide-left active d-none" id="slide-left"> <svg
                                                xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z">
                                                </path>
                                            </svg> </div>
                                        <ul class="main-menu active" style="margin-left: 0px; margin-right: 0px;">
                                            <!-- Start::slide__category -->
                                            <li class="slide__category"><span class="category-name">Main</span></li>

                                            <li class="slide"> <a href="index.html" class="side-menu__item"> <svg
                                                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"
                                                        viewBox="0 0 24 24">
                                                        <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                        <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z"
                                                            opacity=".3"></path>
                                                        <path
                                                            d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z">
                                                        </path>
                                                    </svg> <span class="side-menu__label">Index</span> <span
                                                        class="badge bg-success ms-auto menu-badge">1</span> </a> </li>
                                            {{-- @if(auth()->user()->type == 'Super Admin')
                                            <li class="slide"> <a href="{{route('company.index')}}"
                                                    class="side-menu__item {{request()->segment(1) == 'company' || request()->segment(1) == 'companies' ? 'active' : ''}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="bi bi-building side-menu__icon" viewBox="0 0 16 16">
                                                        <path
                                                            d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                                                        <path
                                                            d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3z" />
                                                    </svg> <span class="side-menu__label">Company</span> </a> </li>
                                            @endif --}}
                                            <!-- End::slide -->

                                            <!-- Start::slide__project -->
                                            <li class="slide__category"><span class="category-name">Event
                                                    Management</span></li>



                                            <li class="slide has-sub"> <a href="javascript:void(0);"
                                                    class="side-menu__item {{request()->segment(2) == 'events' || request()->segment(2) == 'event' ? 'active' : ''}}">
                                                    <svg viewBox="0 0 24 24" fill="none" class="icon side-menu__icon"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path
                                                                d="M8 12C7.44772 12 7 12.4477 7 13C7 13.5523 7.44772 14 8 14H16C16.5523 14 17 13.5523 17 13C17 12.4477 16.5523 12 16 12H8Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M7 17C7 16.4477 7.44772 16 8 16H12C12.5523 16 13 16.4477 13 17C13 17.5523 12.5523 18 12 18H8C7.44772 18 7 17.5523 7 17Z"
                                                                fill="currentColor"></path>
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M8 3C8 2.44772 7.55228 2 7 2C6.44772 2 6 2.44772 6 3V4.10002C3.71776 4.56329 2 6.58104 2 9V17C2 19.7614 4.23858 22 7 22H17C19.7614 22 22 19.7614 22 17V9C22 6.58104 20.2822 4.56329 18 4.10002V3C18 2.44772 17.5523 2 17 2C16.4477 2 16 2.44772 16 3V4H8V3ZM20 10H4V17C4 18.6569 5.34315 20 7 20H17C18.6569 20 20 18.6569 20 17V10ZM4.17071 8C4.58254 6.83481 5.69378 6 7 6H17C18.3062 6 19.4175 6.83481 19.8293 8H4.17071Z"
                                                                fill="currentColor"></path>
                                                        </g>
                                                    </svg>


                                                    <span class="side-menu__label">Event</span> <i
                                                        class="fe fe-chevron-right side-menu__angle"></i> </a>
                                                <ul class="slide-menu child1"
                                                    style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(119.5px, 294px, 0px);"
                                                    data-popper-placement="bottom">

                                                    <li class="slide"> <a href="{{route('event.category.index')}}"
                                                            class="side-menu__item {{ request()->segment(2) == 'event' && request()->segment(3) == 'category' || request()->segment(2) == 'event' && request()->segment(3) == 'categories' ? 'active' : ''}}">Category</a>
                                                    </li>
                                                    <li class="slide"> <a href="{{route('event.featured.index')}}"
                                                            class="side-menu__item {{ request()->segment(2) == 'event' &&  request()->segment(3) == 'featured'  ? 'active' : ''}}">Featured</a>
                                                    </li>
                                                    <li class="slide"> <a href="{{route('event.index')}}"
                                                            class="side-menu__item {{ request()->segment(2) == 'events' &&  request()->segment(3) !== 'categories' || request()->segment(2) == 'event' && request()->segment(3) !== 'category'  ? 'active' : ''}}">List</a>
                                                    </li>
                                                </ul>

                                            </li>
                                            <li class="slide"> <a href="{{route('ticket.account.index')}}"
                                                    class="side-menu__item {{request()->segment(2) == 'ticket' && request()->segment(3) == 'accounts' || request()->segment(2) == 'ticket' && request()->segment(3) == 'account' ? 'active' : ''}}">
                                                    <svg viewBox="0 0 1024 1024" class="side-menu__icon"
                                                        fill="currentColor" version="1.1"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path
                                                                d="M962.4 1012.8s0 0.8 0 0h25.6-25.6zM704 338.4C704 195.2 588.8 78.4 445.6 78.4S187.2 195.2 187.2 338.4s116 260 258.4 260S704 481.6 704 338.4z m-472 0c0-118.4 96-214.4 213.6-214.4s213.6 96 213.6 214.4-96 214.4-213.6 214.4S232 456.8 232 338.4z"
                                                                fill=""></path>
                                                            <path
                                                                d="M456.8 621.6c196.8 0 361.6 136 394.4 324h45.6C863.2 732 677.6 576.8 456 576.8c-221.6 0-406.4 155.2-440.8 368.8h45.6C96 756.8 260 621.6 456.8 621.6z"
                                                                fill=""></path>
                                                            <path
                                                                d="M770.4 578.4l-24-8.8 20.8-14.4c65.6-46.4 104.8-122.4 103.2-202.4-1.6-128-102.4-232.8-228-241.6v47.2c100 8.8 180 92.8 180.8 194.4 0.8 52.8-19.2 102.4-56 140.8-36.8 37.6-86.4 59.2-139.2 60-24.8 0-50.4 0-75.2 1.6-15.2 1.6-41.6 0-54.4 9.6-1.6 0.8-3.2 0-4.8 0l-9.6 12c-0.8 1.6-2.4 3.2-4 4.8 0.8 1.6-0.8 16 0 17.6 12 4 71.2 0 156.8 2.4 179.2 1.6 326.4 160.8 340.8 338.4l47.2 3.2c-9.6-156-108-310.4-254.4-364.8z"
                                                                fill=""></path>
                                                        </g>
                                                    </svg>


                                                    <span class="side-menu__label">Accounts</span> </a>
                                               

                                            </li>

                                            <!-- Start::slide__account -->
                                            <li class="slide__category"><span class="category-name">Pass
                                                    Management</span></li>

                                            <li class="slide has-sub"> <a href="javascript:void(0);"
                                                    class="side-menu__item {{request()->segment(2) == 'accounts' || request()->segment(2) == 'account' ? 'active' : ''}}">
                                                    <svg viewBox="0 0 1024 1024" class="side-menu__icon"
                                                        fill="currentColor" version="1.1"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path
                                                                d="M962.4 1012.8s0 0.8 0 0h25.6-25.6zM704 338.4C704 195.2 588.8 78.4 445.6 78.4S187.2 195.2 187.2 338.4s116 260 258.4 260S704 481.6 704 338.4z m-472 0c0-118.4 96-214.4 213.6-214.4s213.6 96 213.6 214.4-96 214.4-213.6 214.4S232 456.8 232 338.4z"
                                                                fill=""></path>
                                                            <path
                                                                d="M456.8 621.6c196.8 0 361.6 136 394.4 324h45.6C863.2 732 677.6 576.8 456 576.8c-221.6 0-406.4 155.2-440.8 368.8h45.6C96 756.8 260 621.6 456.8 621.6z"
                                                                fill=""></path>
                                                            <path
                                                                d="M770.4 578.4l-24-8.8 20.8-14.4c65.6-46.4 104.8-122.4 103.2-202.4-1.6-128-102.4-232.8-228-241.6v47.2c100 8.8 180 92.8 180.8 194.4 0.8 52.8-19.2 102.4-56 140.8-36.8 37.6-86.4 59.2-139.2 60-24.8 0-50.4 0-75.2 1.6-15.2 1.6-41.6 0-54.4 9.6-1.6 0.8-3.2 0-4.8 0l-9.6 12c-0.8 1.6-2.4 3.2-4 4.8 0.8 1.6-0.8 16 0 17.6 12 4 71.2 0 156.8 2.4 179.2 1.6 326.4 160.8 340.8 338.4l47.2 3.2c-9.6-156-108-310.4-254.4-364.8z"
                                                                fill=""></path>
                                                        </g>
                                                    </svg>


                                                    <span class="side-menu__label">Accounts</span> <i
                                                        class="fe fe-chevron-right side-menu__angle"></i> </a>
                                                <ul class="slide-menu child1"
                                                    style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(119.5px, 294px, 0px);"
                                                    data-popper-placement="bottom">

                                                    <li class="slide"> <a href="{{route('account.index')}}"
                                                            class="side-menu__item {{ request()->segment(2) == 'account' || request()->segment(2) == 'accounts' && request()->segment(3) !== 'details' ? 'active' : ''}}">Lists</a>
                                                    </li>
                                                    <li class="slide"> <a href="{{route('account.details.index')}}"
                                                            class="side-menu__item {{ request()->segment(2) == 'account' &&  request()->segment(3) == 'details'  ? 'active' : ''}}">Details</a>
                                                    </li>
                                                </ul>

                                            </li>
                                            <li class="slide"> <a href="{{route('faq.index')}}"
                                                    class="side-menu__item {{request()->segment(2) == 'faq' || request()->segment(2) == 'faqs' ? 'active' : ''}}">

                                                    <svg fill="currentColor" class="side-menu__icon" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path
                                                                d="M12,1A11,11,0,1,0,23,12,11.013,11.013,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9.011,9.011,0,0,1,12,21Zm1-4.5v2H11v-2Zm3-7a3.984,3.984,0,0,1-1.5,3.122A3.862,3.862,0,0,0,13.063,15H11.031a5.813,5.813,0,0,1,2.219-3.936A2,2,0,0,0,13.1,7.832a2.057,2.057,0,0,0-2-.14A1.939,1.939,0,0,0,10,9.5,1,1,0,0,1,8,9.5V9.5a3.909,3.909,0,0,1,2.319-3.647,4.061,4.061,0,0,1,3.889.315A4,4,0,0,1,16,9.5Z">
                                                            </path>
                                                        </g>
                                                    </svg>

                                                    <span class="side-menu__label">FAQs</span>
                                                </a>
                                            </li>
                                            <li class="slide"> <a href="{{route('testimonial.index')}}"
                                                    class="side-menu__item {{request()->segment(2) == 'testimonials' || request()->segment(2) == 'testimonial' ? 'active' : ''}}">

                                                    <svg fill="currentColor" class="side-menu__icon" version="1.1"
                                                        id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 490 490"
                                                        xml:space="preserve">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g>
                                                                <g>
                                                                    <path
                                                                        d="M446.52,174.433c-27.254-20.921-63.341-32.443-101.616-32.443c-23.143,0-45.482,4.22-65.555,12.175 c-10.033-19.097-26.771-36.009-48.063-48.316c-25.068-14.491-54.873-22.15-86.189-22.15c-38.275,0-74.362,11.522-101.616,32.443 C15.441,137.664,0,166.525,0,197.406c0,27.813,12.723,54.284,35.936,75.01l0.395,67.755c0.02,3.536,1.814,6.968,4.961,8.58 c3.736,1.915,7.299,1.457,9.912,0.094l70.288-39.229c7.793,0.996,15.715,1.5,23.605,1.5c0.002,0,0.004,0,0.006,0 c22.85,0,45.271-4.194,65.465-12.174c7.369,14.116,18.396,27.029,32.719,38.024c27.254,20.921,63.342,32.442,101.617,32.442 c7.928,0,15.895-0.51,23.729-1.516l70.376,37.09c3.994,2.034,6.955,1.537,9.803-0.27c2.949-1.871,4.838-5.024,4.859-8.518 l0.395-65.485C477.277,309.984,490,283.511,490,255.699C490,224.818,474.559,195.958,446.52,174.433z M145.102,291.115 c-0.002,0-0.006,0-0.006,0c-8.143,0-16.324-0.602-24.314-1.786c-2.861-0.422-5.617,0.407-7.713,2.082L56.23,323.135l-0.32-55.185 c0.004-0.2,0-0.402-0.01-0.604c-0.131-2.81-1.438-5.435-3.604-7.231C31.471,242.833,20,220.562,20,197.406 c0-51.671,56.119-93.708,125.097-93.708c51.104,0,97.307,23.872,116.152,59.002c-6.324,3.5-12.334,7.413-17.963,11.733 c-28.039,21.524-43.48,50.385-43.48,81.266c0,8.404,1.154,16.657,3.383,24.656C185.337,287.409,165.442,291.115,145.102,291.115z M437.703,318.408c-2.164,1.796-3.471,4.423-3.602,7.232c-0.01,0.182-0.012,0.363-0.012,0.544l-0.32,53.429l-57.021-30.051 c-2.072-1.581-4.75-2.352-7.533-1.94c-7.992,1.186-16.172,1.787-24.313,1.787c-56.488,0-104.342-28.194-119.824-66.782 c-0.064-0.188-0.146-0.371-0.223-0.557c-3.281-8.369-5.051-17.218-5.051-26.371c0-33.247,23.238-62.503,58.182-79.141 c0.025-0.01,0.051-0.016,0.076-0.026c0.391-0.154,0.762-0.338,1.123-0.535c19.109-8.874,41.627-14.007,65.717-14.007 c68.978,0,125.097,42.038,125.097,93.709C470,278.854,458.529,301.125,437.703,318.408z">
                                                                    </path>
                                                                    <path
                                                                        d="M403.65,222.195H286.155c-5.523,0-10,4.477-10,10c0,5.523,4.477,10,10,10H403.65c5.521,0,10-4.477,10-10 C413.65,226.672,409.172,222.195,403.65,222.195z">
                                                                    </path>
                                                                    <path
                                                                        d="M403.65,267.469H286.155c-5.523,0-10,4.477-10,10c0,5.523,4.477,10,10,10H403.65c5.521,0,10-4.477,10-10 C413.65,271.946,409.172,267.469,403.65,267.469z">
                                                                    </path>
                                                                </g>
                                                                <g>
                                                                    <path
                                                                        d="M446.52,174.433c-27.254-20.921-63.341-32.443-101.616-32.443c-23.143,0-45.482,4.22-65.555,12.175 c-10.033-19.097-26.771-36.009-48.063-48.316c-25.068-14.491-54.873-22.15-86.189-22.15c-38.275,0-74.362,11.522-101.616,32.443 C15.441,137.664,0,166.525,0,197.406c0,27.813,12.723,54.284,35.936,75.01l0.395,67.755c0.02,3.536,1.814,6.968,4.961,8.58 c3.736,1.915,7.299,1.457,9.912,0.094l70.288-39.229c7.793,0.996,15.715,1.5,23.605,1.5c0.002,0,0.004,0,0.006,0 c22.85,0,45.271-4.194,65.465-12.174c7.369,14.116,18.396,27.029,32.719,38.024c27.254,20.921,63.342,32.442,101.617,32.442 c7.928,0,15.895-0.51,23.729-1.516l70.376,37.09c3.994,2.034,6.955,1.537,9.803-0.27c2.949-1.871,4.838-5.024,4.859-8.518 l0.395-65.485C477.277,309.984,490,283.511,490,255.699C490,224.818,474.559,195.958,446.52,174.433z M145.102,291.115 c-0.002,0-0.006,0-0.006,0c-8.143,0-16.324-0.602-24.314-1.786c-2.861-0.422-5.617,0.407-7.713,2.082L56.23,323.135l-0.32-55.185 c0.004-0.2,0-0.402-0.01-0.604c-0.131-2.81-1.438-5.435-3.604-7.231C31.471,242.833,20,220.562,20,197.406 c0-51.671,56.119-93.708,125.097-93.708c51.104,0,97.307,23.872,116.152,59.002c-6.324,3.5-12.334,7.413-17.963,11.733 c-28.039,21.524-43.48,50.385-43.48,81.266c0,8.404,1.154,16.657,3.383,24.656C185.337,287.409,165.442,291.115,145.102,291.115z M437.703,318.408c-2.164,1.796-3.471,4.423-3.602,7.232c-0.01,0.182-0.012,0.363-0.012,0.544l-0.32,53.429l-57.021-30.051 c-2.072-1.581-4.75-2.352-7.533-1.94c-7.992,1.186-16.172,1.787-24.313,1.787c-56.488,0-104.342-28.194-119.824-66.782 c-0.064-0.188-0.146-0.371-0.223-0.557c-3.281-8.369-5.051-17.218-5.051-26.371c0-52.682,56.998-93.709,125.098-93.709 S470,204.028,470,255.699C470,278.854,458.529,301.125,437.703,318.408z">
                                                                    </path>
                                                                    <path
                                                                        d="M403.65,222.195H286.155c-5.523,0-10,4.477-10,10c0,5.523,4.477,10,10,10H403.65c5.521,0,10-4.477,10-10 C413.65,226.672,409.172,222.195,403.65,222.195z">
                                                                    </path>
                                                                    <path
                                                                        d="M403.65,267.469H286.155c-5.523,0-10,4.477-10,10c0,5.523,4.477,10,10,10H403.65c5.521,0,10-4.477,10-10 C413.65,271.946,409.172,267.469,403.65,267.469z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </svg>

                                                    <span class="side-menu__label">Testimonials</span>
                                                </a>
                                            </li>
                                            <li class="slide"> <a href="#"
                                                    class="side-menu__item {{request()->segment(1) == 'company' || request()->segment(1) == 'companies' ? 'active' : ''}}">

                                                    <svg fill="currentColor" class="side-menu__icon"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path
                                                                d="M3 15H21M3 19H15M3 7H11M3 11H11M19.4 11H16.6C16.0399 11 15.7599 11 15.546 10.891C15.3578 10.7951 15.2049 10.6422 15.109 10.454C15 10.2401 15 9.96005 15 9.4V6.6C15 6.03995 15 5.75992 15.109 5.54601C15.2049 5.35785 15.3578 5.20487 15.546 5.10899C15.7599 5 16.0399 5 16.6 5H19.4C19.9601 5 20.2401 5 20.454 5.10899C20.6422 5.20487 20.7951 5.35785 20.891 5.54601C21 5.75992 21 6.03995 21 6.6V9.4C21 9.96005 21 10.2401 20.891 10.454C20.7951 10.6422 20.6422 10.7951 20.454 10.891C20.2401 11 19.9601 11 19.4 11Z"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </g>
                                                    </svg>
                                                    <span class="side-menu__label">Contents</span>
                                                </a>
                                            </li>

                                        </ul>
                                        <div class="slide-right d-none" id="slide-right"><svg
                                                xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                                </path>
                                            </svg></div>
                                    </nav> <!-- End::nav -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="simplebar-placeholder" style="width: auto; height: 954px;"></div>
                </div>
                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                    <div class="simplebar-scrollbar"
                        style="width: 0px; transform: translate3d(0px, 0px, 0px); display: none;"></div>
                </div>
                <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                    <div class="simplebar-scrollbar"
                        style="height: 771px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                </div>
            </div> <!-- End::main-sidebar -->
        </aside> <!-- End::app-sidebar -->
        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">
                <!-- Page Header -->
                <x-breadcrumb />
                <!-- Page Header Close -->
                <!-- Start::row-1 -->
                <div class="row">
                    {{$slot}}
                </div>
                @if(session()->has('success'))
                <div class="success flash p-3 p-md-4 p-lg-3 p-xl-3 position-fixed bg-white rounded"
                    x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)">
                    <div class="d-flex flex-row align-item-center gap-3">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"
                                fill="none">
                                <path opacity="0.5"
                                    d="M44 24C44 35.0457 35.0457 44 24 44C12.9543 44 4 35.0457 4 24C4 12.9543 12.9543 4 24 4C35.0457 4 44 12.9543 44 24Z"
                                    fill="#92BCAE" />
                                <path
                                    d="M32.0607 17.9393C32.6464 18.5251 32.6464 19.4749 32.0607 20.0607L22.0607 30.0607C21.4749 30.6464 20.5251 30.6464 19.9393 30.0607L15.9393 26.0607C15.3536 25.4749 15.3536 24.5251 15.9393 23.9393C16.5251 23.3536 17.4749 23.3536 18.0607 23.9393L21 26.8787L25.4697 22.409L29.9393 17.9393C30.5251 17.3536 31.4749 17.3536 32.0607 17.9393Z"
                                    fill="#081C15" />
                            </svg>
                        </div>
                        <div class="message d-flex flex-column flex-start justify-content-center">
                            <h5>
                                Successfull
                            </h5>
                            <p class="mb-0"> {{session('success')}}</p>
                        </div>
                    </div>
                </div>
                @endif
                @if(session()->has('error'))
                <div class="error flash p-3 p-md-4 p-lg-3 p-xl-3 position-fixed bg-white rounded"
                    x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)">
                    <div class="d-flex flex-row align-item-center gap-3">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"
                                fill="none">
                                <path opacity="0.5"
                                    d="M44 24C44 12.9543 35.0457 4 24 4C12.9543 4 4 12.9543 4 24C4 35.0457 12.9543 44 24 44C35.0457 44 44 35.0457 44 24Z"
                                    fill="#FF6F6F" />
                                <path
                                    d="M24 12.5C24.8284 12.5 25.5 13.1716 25.5 14V26C25.5 26.8284 24.8284 27.5 24 27.5C23.1716 27.5 22.5 26.8284 22.5 26V14C22.5 13.1716 23.1716 12.5 24 12.5Z"
                                    fill="#081C15" />
                                <path
                                    d="M24 34C25.1046 34 26 33.1046 26 32C26 30.8954 25.1046 30 24 30C22.8954 30 22 30.8954 22 32C22 33.1046 22.8954 34 24 34Z"
                                    fill="#081C15" />
                            </svg>
                        </div>
                        <div class="message d-flex flex-column gap-2 flex-start justify-content-center">
                            <h5>
                                {{ session('error') }}
                            </h5>
                            <p class="mb-0">Please try again later!</p>
                        </div>
                    </div>
                </div>
                @endif
                <!--End::row-1 -->
            </div>
        </div> <!-- End::app-content -->

    </div>

    @stack('dropdowns')
    <script src="{{asset('assets/libs/@popperjs/core/umd/popper.min.js')}}"></script>

    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('assets/js/defaultmenu.min.js')}}"></script>

    <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

    <script src="{{asset('assets/js/sticky.js')}}"></script>

    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>

    <script src="{{asset('assets/js/simplebar.js')}}"></script>
    <script src="{{asset('assets/libs/@simonwep/pickr/pickr.es5.min.js')}}"></script>

    <script src="{{asset('assets/js/custom-switcher.min.js')}}"></script>

    <script src="{{asset('assets/js/custom.js')}}"></script>

</body>

</html>