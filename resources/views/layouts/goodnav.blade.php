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
                    <li class="nav-item dropdown no-arrow mx-1" id="notiarea">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="/icon/bell.svg" class="fas fa-fw">
                            <!-- Counter - 未讀通知計數 -->
                            <span class="badge badge-danger badge-counter" id="no_read_count" {{ $notifications->count() == 0  ? "hidden":""}}>{{ $notifications->count()}}</span>
                        </a>
                        <!-- Dropdown - 未讀通知顯示 -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in "
                            aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                通知
                            </h6>
                            <div id="no_read_content">
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
                            </div>
                            @if ($notifications->count() != 0)
                                <a class="dropdown-item text-center small text-gray-500 no_read_foot" id="all_read" href="#">全部已讀</a>
                                <a class="dropdown-item text-center small text-gray-500 no_read_foot" id="no_unread_noti" hidden href="#">沒有未讀通知</a>
                            @else
                                <a class="dropdown-item text-center small text-gray-500 no_read_foot" id="all_read" hidden href="#">全部已讀</a>
                                <a class="dropdown-item text-center small text-gray-500 no_read_foot" id="no_unread_noti" href="#">沒有未讀通知</a>
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
                    var count0 =$('#no_read_count').text();
                    function notirefresh(){
                        console.log(count0);
                        var $this = $(this)
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            method:'POST',
                            url:'get-notification',
                            data: {'count': count0,}
                        })
                        .done(function(notifications){
                            if(count0 ==0){
                                    var navcount= document.getElementById("all_read").hidden = false;
                                    var navcount= document.getElementById("no_unread_noti").hidden = true;
                                }
                            var end=notifications.countSer-count0;
                            count0 =notifications.countSer;
                            if(notifications.notifications == "nonew"){
                            }else{
                                var navcount= document.getElementById("no_read_count").hidden = false;
                                $('#no_read_count').text(count0);
                                for(i=0;i<end ;i++){
                                    //console.log(notifications.notifications[i].data);
                                    let date = new Date(notifications.notifications[i].created_at);
                                    $('#no_read_content').append('<a class="dropdown-item d-flex align-items-center read_notification" data-id="{{'+notifications.notifications[i].id+'"  href="/sms-lists"><div class="mr-3"></div><div><div class="small text-gray-500">'+date+'</div><span class="font-weight-bold">'+notifications.notifications[i].data+'</span></div></a>');
                                    var notification = new Notification(notifications.notifications[i].data, {
                                                                                icon: '/icon/send.svg',
                                                                                body: '內文請在簡訊列表查看',
                                                                            });

                                }

                            }

                        })
                        setTimeout('notirefresh()',6000);
                    }
                    setTimeout('notirefresh()',15000);
                </script>
            @stack('modals')
