<!DOCTYPE html>
<html lang="zh-Hant-TW">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>簡訊過濾提醒</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="/css/css2.css">
        <!-- Styles -->
        <link href="/css/sb-admin-2.min.css" rel="stylesheet">
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/DataTables/datatables.min.css"/>
        <link rel="stylesheet" type="text/css" href="/css/input.css"/>
        @livewireStyles

        <!-- Scripts -->
        <script src="/js/jquery-3.6.0.min.js"></script>
        <script src="/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="/DataTables/datatables.min.js"></script>
    </head>
    <body class="font-sans sidebar-toggled antialiased" id="page-top">
        <div id="wrapper">
                        <!-- Sidebar -->

                <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion collapse show toggled" id="navbarToggleExternalContent">
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
                    <li class="nav-item">
                        <p></p>
                        <div class="text-center d-none d-md-inline">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('　登出　') }}
                                </x-jet-responsive-nav-link>
                            </form>
                        </div>
                        <p></p>
                    </li>
                    <!-- Divider -->
                    <hr class="sidebar-divider">
                    <!-- Heading -->
                    <div class="sidebar-heading">
                        功能選單
                    </div>
                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="/sms-lists">
                            <img src="/icon/chat-left-text.svg" class="fas fa-fw"> <span>簡訊列表</span>
                        </a>
                    </li>
                    <!-- Nav Item - Utilities Collapse Menu -->
                    @can('common')
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="/devices">
                            <img src="/icon/phone.svg" class="fas fa-fw">
                            <span>裝置管理</span>
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
                        <a class="nav-link collapsed" href="/allow-lists"
                            >
                            <img src="/icon/file-lock2.svg" class="fas fa-fw">
                            <span>IP白名單群組管理</span>
                        </a>
                    </li>
                    <hr class="sidebar-divider">

                    </li>
                    @endcan
                    <!-- Nav Item - Utilities Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="/docmenu"
                            >
                             <img src="/icon/file-earmark-text.svg" class="fas fa-fw">
                            <span>說明文件</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="/app-download"
                            >
                             <img src="/icon/desktop-download.svg" class="fas fa-fw">
                            <span>APP下載</span>
                        </a>
                    </li>
                    <!-- Divider -->


                    <hr class="sidebar-divider">

                        <div class="text-center d-none d-md-inline position-relative">
                            <button class="fas fa-fw rounded-circle border-0" id="sidebarToggle"></button>
                        </div>
                </ul>
                <!-- End of Sidebar -->
            <div id="content-wrapper" class="d-flex flex-column ">
                @include('layouts.goodnav')
            </div>
        </div>
        <a class="scroll-to-top" href="#page-top">
            <i>^</i>
        </a>
    </body>

    <script>
        if (!('Notification' in window)) {
            console.log('此瀏覽器不支援通知功能');
        }
        if (Notification.permission === 'default' || Notification.permission === 'undefined') {
            Notification.requestPermission(function(permission) {
            // permission 可為「granted」（同意）、「denied」（拒絕）和「default」（未授權）
            // 在這裡可針對使用者的授權做處理
                if (permission === 'granted') {
                // 使用者同意授權
                var notification = new Notification('已開啟通知!', notifyConfig); // 建立通知
                }
            });
        }
        var notifyConfig = {
        body: '\\ ^o^ / ', // 設定內容
        icon: '/icon/send.svg', // 設定 icon
        requireInteraction:true,
        };

        $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
            $("body").toggleClass("sidebar-toggled");
            $(".sidebar").toggleClass("toggled");
            if ($(".sidebar").hasClass("toggled")) {
            $('.sidebar .collapse').collapse('hide');
            };
        });
        $(document).on('scroll', function() {
            var scrollDistance = $(this).scrollTop();
            if (scrollDistance > 100) {
            $('.scroll-to-top').fadeIn();
            } else {
            $('.scroll-to-top').fadeOut();
            }
        });
    </script>
</html>
