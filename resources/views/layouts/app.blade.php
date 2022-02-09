<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="/css/css2.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link href="/css/sb-admin-2.min.css" rel="stylesheet">
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/DataTables/datatables.min.css"/>
        <link rel="stylesheet" type="text/css" href="/css/input.css"/>
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="/js/jquery-3.6.0.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>

        <script type="text/javascript" src="/DataTables/datatables.min.js"></script>
    </head>
    <body class="font-sans antialiased" id="page-top">
        <div id="wrapper">
                        <!-- Sidebar -->

                <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion collapse show"" id="navbarToggleExternalContent">
                    <!-- Sidebar - Brand -->
                    <div class="sidebar-brand d-flex align-items-center justify-content-center">
                        <div class="sidebar-brand-icon rotate-n-15">
                            <i class="fas fa-laugh-wink"></i>
                        </div>
                        <div class="sidebar-brand-text ">簡訊過濾提醒 </div>
                    </div>
                    <!-- Divider -->
                    <hr class="sidebar-divider my-0">

                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item active">
                        <a class="nav-link" href=" ">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>平台</span></a>
                    </li>

                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Heading -->
                    <div class="sidebar-heading">
                        功能選單
                    </div>

                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="/sms-lists"
                            >
                            <img src="/icon/chat-left-text.svg" class="fas fa-fw"> <span>簡訊列表</span>
                        </a>
                    </li>

                    <!-- Nav Item - Utilities Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="/accounts"
                            >
                            <img src="/icon/people.svg" class="fas fa-fw">
                            <span>管理者權限設定</span>
                        </a>
                    </li>
                     <!-- Nav Item - Utilities Collapse Menu -->
                     <li class="nav-item">
                        <a class="nav-link collapsed" href="/devices"
                            >
                            <img src="/icon/phone.svg" class="fas fa-fw"><span>裝置管理</span>
                        </a>
                    </li>
                     <!-- Nav Item - Utilities Collapse Menu -->
                     <li class="nav-item">
                        <a class="nav-link collapsed" href="/allow-lists"
                            >
                            <img src="/icon/file-lock2.svg" class="fas fa-fw">
                            <span>IP白名單群組管理</span>
                        </a>
                    </li>
                    <!-- Nav Item - Utilities Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="/newapitest"
                            >
                             <img src="/icon/file-earmark-text.svg" class="fas fa-fw">
                            <span>API測試</span>
                        </a>
                    </li>
                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('　登出　') }}
                            </x-jet-responsive-nav-link>
                        </form>
                    </li>




                </ul>
                <!-- End of Sidebar -->


            <div id="content-wrapper" class="d-flex flex-column ">
                @include('layouts.nav')
            </div>

        </div>

    </body>

</html>
