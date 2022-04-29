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
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-text" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                              </svg><span>簡訊列表</span>
                        </a>
                    </li>
                    <!-- Nav Item - Utilities Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="/accounts">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                            </svg>
                            <span>管理者權限設定</span>
                        </a>
                    </li>
                    <!-- Nav Item - Utilities Collapse Menu -->
                    @can('common')
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="/devices">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
                                <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/>
                                <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                            </svg>
                            <span>裝置管理</span>
                        </a>
                    </li>

                     <!-- Nav Item - Utilities Collapse Menu -->

                     <li class="nav-item">
                        <a class="nav-link collapsed" href="/allow-lists">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-lock2" viewBox="0 0 16 16">
                                <path d="M8 5a1 1 0 0 1 1 1v1H7V6a1 1 0 0 1 1-1zm2 2.076V6a2 2 0 1 0-4 0v1.076c-.54.166-1 .597-1 1.224v2.4c0 .816.781 1.3 1.5 1.3h3c.719 0 1.5-.484 1.5-1.3V8.3c0-.627-.46-1.058-1-1.224z"/>
                                <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                            </svg>
                            <span>IP白名單群組管理</span>
                        </a>
                    </li>
                    <hr class="sidebar-divider">

                    </li>
                    @endcan
                    <!-- Nav Item - Utilities Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="/docmenu">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                                <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
                                <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                            </svg>
                            <span>說明文件</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="/app-download">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
                                <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/>
                                <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                            </svg>
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

        $("#sidebarToggle").on('click', function(e) {
            $("body").toggleClass("sidebar-toggled");
            $(".sidebar").toggleClass("toggled");
            if ($(".sidebar").hasClass("toggled")) {
            $('.sidebar .collapse').collapse('hide');

            };
        });


        $("#sidebarToggleTop").on('click', function(e) {
            $(".sidebar").toggle();
            $("body").toggleClass("toggled");

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
