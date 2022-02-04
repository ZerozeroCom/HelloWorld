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
            <div class="collapse show" id="navbarToggleExternalContent">
                <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-dots" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg> <span>簡訊列表</span>
                        </a>
                    </li>

                    <!-- Nav Item - Utilities Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="/accounts"
                            >
                            <i class="fas fa-fw fa-wrench"></i>
                            <span>管理者權限設定</span>
                        </a>
                    </li>
                     <!-- Nav Item - Utilities Collapse Menu -->
                     <li class="nav-item">
                        <a class="nav-link collapsed" href="/devices"
                            >
                            <i class="fas fa-fw fa-wrench"></i>
                            <span>裝置管理</span>
                        </a>
                    </li>
                     <!-- Nav Item - Utilities Collapse Menu -->
                     <li class="nav-item">
                        <a class="nav-link collapsed" href="/allow-lists"
                            >
                            <i class="fas fa-fw fa-wrench"></i>
                            <span>IP白名單管理</span>
                        </a>
                    </li>
                    <!-- Nav Item - Utilities Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="/newapitest"
                            >
                            <i class="fas fa-fw fa-wrench"></i>
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
            </div>

             <div id="content-wrapper" class="d-flex flex-column ">
                @include('layouts.nav')

        </div>

    </body>

</html>
