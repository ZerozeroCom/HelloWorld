            <!-- Topbar -->
            <nav class="navbar navbar-expand bg-gradient-secondary border-b  topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn  d-md-none rounded-circle mr-3">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"  d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <a style="display:none;">{{ $notifications =Auth::user()->notifications ?? []; }}</a>
                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="/icon/bell.svg" class="fas fa-fw">
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter">{{$notifications->count()}}</span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in "
                            aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                通知
                            </h6>
                            @foreach ($notifications as $notification)
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                </div>
                                <div>
                                    <div class="small text-gray-500">{{$notification->created_at}}</div>
                                    <span class="font-weight-bold">{{$notification->data[0]}}</span>
                                </div>
                            </a>
                            @endforeach
                            <a class="dropdown-item text-center small text-gray-500" href="#">顯示全部</a>
                        </div>
                    </li>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle">
                            <span class="mr-2 d-none d-lg-inline text-gray-200 small">{{ Auth::user()->name }}</span>
                        </a>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->


                <div class="m-2 p-2"  >
                    @yield('content')
                </div>

            @stack('modals')
