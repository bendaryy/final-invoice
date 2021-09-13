<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from designreset.com/cork/rtl/demo3/table_dt_html5.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 19 Mar 2021 13:07:48 GMT -->

<head>
    @yield('head')
    <!-- END PAGE LEVEL CUSTOM STYLES -->
</head>

<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container fixed-top" style="padding: 0;margin: 0">
        <header class="header navbar navbar-expand-sm">


            <ul class="navbar-item theme-brand flex-row  text-center">
                <li class="nav-item theme-logo">
                    <a href="{{ route('dashboard') }}">

                        @yield('image')
                        {{-- <img src="assets/img/sora.jpg" class="navbar-logo" alt="logo"> --}}
                    </a>
                </li>
                <li class="nav-item theme-text">
                    <a href="{{ route('dashboard') }}" class="nav-link"> الفاتورة
                        الإلكترونية </a>
                </li>
            </ul>



        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container fixed-top">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg></a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">

                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" style="font-size: 25px"><a href="javascript:void(0);">
                                        @yield('page')

                                    </a></li>

                            </ol>
                        </nav>

                    </div>
                </li>
            </ul>
            <ul class="navbar-nav flex-row ml-auto ">
                <li class="nav-item more-dropdown">
                    <div class="dropdown  custom-dropdown-icon">
                        <a class="dropdown-toggle btn" href="#" role="button" id="customDropdown" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><span>{{ auth()->user()->name }}</span> <svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg></a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="customDropdown">

                            <a class="dropdown-item" data-value="الملف الشخصى"
                                style="color: white;font-size: 15px;text-align: center;margin:auto;opacity:0.7;font-weight: bold"
                                href="{{ route('profile.show') }}">الملف
                                الشخصى</a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit"
                                    style="color: white;font-size: 15px;text-align: center;margin:auto;opacity:0.7">تسجيل
                                    خروج</button>
                            </form>

                        </div>
                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">

            <nav id="sidebar">
                <div class="shadow-bottom"></div>

                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu">
                        <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                <span>خيارات الفاتورة</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-right">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="dashboard" data-parent="#accordionExample">
                            <li>
                                <a href="{{ route('createInvoice') }}"> إنشاء فاتورة جديدة </a>
                            </li>
                            <li>
                                <a href="{{ route('showAllInvoices') }}"> الفواتير التى تم إرسالها</a>
                            </li>
                            <li>
                                <a href="{{ route('showAllInvoices2') }}"> الفواتير التى تم إستقبالها</a>
                            </li>
                        </ul>
                    </li>







                </ul>

            </nav>

        </div>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing" id="cancel-row">

                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            @yield('content')
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->










    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    @yield('js')
    <!-- END PAGE LEVEL CUSTOM SCRIPTS -->
</body>

<!-- Mirrored from designreset.com/cork/rtl/demo3/table_dt_html5.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 19 Mar 2021 13:07:50 GMT -->

</html>
