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
                    <a style="display:none">{{ $notifications =Auth::user()->unreadNotifications ?? []; }}</a>
                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="/icon/bell.svg" class="fas fa-fw">
                            <!-- Counter - 未讀通知計數 -->
                            <span class="badge badge-danger badge-counter" style="{{ $notifications->count() == 0  ? "display:none":""}}">{{ $notifications->count()}}</span>
                        </a>
                        <!-- Dropdown - 未讀通知顯示 -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in "
                            aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                通知
                            </h6>
                            @foreach ($notifications as $notification)
                            <a class="dropdown-item d-flex align-items-center read_notification" data-id="{{$notification->id}}"  href="/sms-lists">
                                <div class="mr-3">
                                    <span class="read">
                                        @if ($notification->read_at)
                                            (已讀)
                                        @endif
                                    </span>
                                </div>
                                <div>
                                    <div class="small text-gray-500">{{$notification->created_at}}</div>
                                    <span class="font-weight-bold">{{$notification->data[0]}}</span>
                                </div>
                            </a>
                            @endforeach
                            @if ($notifications->count() != 0)
                                <a class="dropdown-item text-center small text-gray-500" id="all_read" href="#">全部已讀</a>
                            @else
                                <a class="dropdown-item text-center small text-gray-500"  href="#">沒有未讀通知</a>
                            @endif

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

                <script>
                    $('.read_notification').on('click',function(){
                        var $this = $(this)
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            method:'POST',
                            url:'read-notification',
                            data: {id: $this.data('id')}

                        })
                        .done(function(msg){
                            if(msg.result){
                                $this.find('.read').text('(已讀)')
                            }
                        })
                    })
                    $('#all_read').on('click',function(){
                        var $this = $(this)
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            method:'POST',
                            url:'read-all-notification',
                            data: {'ok':1}
                        })
                        .done(function(msg){
                            top.location.reload()
                        })
                    })
                </script>
            @stack('modals')
